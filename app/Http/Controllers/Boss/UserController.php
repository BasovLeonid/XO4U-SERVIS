<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Поиск
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('telegram_username', 'like', "%{$search}%");
            });
        }

        // Фильтр по роли
        if ($request->filled('role')) {
            $query->where('role', $request->get('role'));
        }

        // Сортировка
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Пагинация
        $perPage = $request->get('per_page', 10);
        $users = $query->paginate($perPage);

        // Статистика регистраций по месяцам
        $registrationStats = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => \Carbon\Carbon::createFromFormat('Y-m', $item->month)->format('F Y'),
                    'count' => $item->count
                ];
            });

        return view('boss.users.index', compact('users', 'sort', 'direction', 'perPage', 'registrationStats'));
    }

    public function create()
    {
        return view('boss.users.create');
    }

    public function store(Request $request)
    {
        // Отладочная информация
        \Log::info('Received user data:', $request->all());

        // Базовая валидация
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'telegram_username' => 'nullable|string|max:255',
            'role' => ['required', 'string', Rule::in(['admin', 'user', 'partner'])],
            'balance' => 'nullable|numeric|min:0',
            'total_spent' => 'nullable|numeric|min:0',
            'repeat_purchases' => 'nullable|integer|min:0',
            'payment_rating' => 'nullable|numeric|min:0|max:100',
        ]);

        \Log::info('Validated data:', $validated);

        // Дополнительная валидация и подготовка данных
        $validated['password'] = Hash::make($validated['password']);

        // Обработка числовых полей
        $validated['balance'] = floatval($request->input('balance', 0));
        $validated['total_spent'] = floatval($request->input('total_spent', 0));
        $validated['repeat_purchases'] = intval($request->input('repeat_purchases', 0));
        $validated['payment_rating'] = floatval($request->input('payment_rating', 0));

        // Проверка и округление числовых значений
        $validated['balance'] = round(max(0, $validated['balance']), 2);
        $validated['total_spent'] = round(max(0, $validated['total_spent']), 2);
        $validated['repeat_purchases'] = max(0, $validated['repeat_purchases']);
        $validated['payment_rating'] = round(max(0, min(100, $validated['payment_rating'])), 1);

        \Log::info('Final data to save:', $validated);

        $user = User::create($validated);
        \Log::info('Created user:', $user->toArray());

        return redirect()->route('boss.users.index')
            ->with('success', 'Пользователь успешно создан');
    }

    public function edit(User $user)
    {
        return view('boss.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Базовая валидация
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'telegram_username' => 'nullable|string|max:255',
            'role' => ['required', 'string', Rule::in(['admin', 'user', 'partner'])],
            'balance' => 'nullable|numeric|min:0',
            'total_spent' => 'nullable|numeric|min:0',
            'repeat_purchases' => 'nullable|integer|min:0',
            'payment_rating' => 'nullable|numeric|min:0|max:100',
        ]);

        // Обработка пароля
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Обработка числовых полей
        $validated['balance'] = floatval($request->input('balance', $user->balance));
        $validated['total_spent'] = floatval($request->input('total_spent', $user->total_spent));
        $validated['repeat_purchases'] = intval($request->input('repeat_purchases', $user->repeat_purchases));
        $validated['payment_rating'] = floatval($request->input('payment_rating', $user->payment_rating));

        // Проверка и округление числовых значений
        $validated['balance'] = round(max(0, $validated['balance']), 2);
        $validated['total_spent'] = round(max(0, $validated['total_spent']), 2);
        $validated['repeat_purchases'] = max(0, $validated['repeat_purchases']);
        $validated['payment_rating'] = round(max(0, min(100, $validated['payment_rating'])), 1);

        $user->update($validated);

        return redirect()->route('boss.users.index')
            ->with('success', 'Пользователь успешно обновлен');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('boss.users.index')
                ->with('error', 'Вы не можете удалить свой аккаунт');
        }

        $user->delete();

        return redirect()->route('boss.users.index')
            ->with('success', 'Пользователь успешно удален');
    }
} 