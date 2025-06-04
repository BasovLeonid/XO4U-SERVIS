<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = Account::with('user');

        // Поиск
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('login', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('subtype', 'like', "%{$search}%");
        }

        // Фильтры
        if ($request->has('type') && $request->get('type')) {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('status') && $request->get('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('user_id') && $request->get('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        // Сортировка
        $query->orderBy('created_at', 'desc');

        $perPage = $request->get('per_page', 10);
        $accounts = $query->paginate($perPage);
        $users = User::all();

        return view('boss.accounts.index', compact('accounts', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('boss.accounts.create', compact('users'));
    }

    public function store(Request $request)
    {
        Log::info('Received account data:', $request->all());

        $validated = $request->validate([
            'type' => 'required|in:yandex,vk',
            'subtype' => 'required|in:created,added',
            'login' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'oauth_token' => 'nullable|string',
            'status' => 'required|in:active,archived,paused',
            'user_id' => 'required|exists:users,id',
            'balance' => 'required|numeric|min:0',
        ]);

        Log::info('Validated data:', $validated);

        $account = Account::create($validated);

        Log::info('Created account:', $account->toArray());

        return redirect()
            ->route('boss.accounts.index')
            ->with('success', 'Аккаунт успешно создан');
    }

    public function edit(Account $account)
    {
        $users = User::all();
        return view('boss.accounts.edit', compact('account', 'users'));
    }

    public function update(Request $request, Account $account)
    {
        Log::info('Received account data for update:', $request->all());

        $validated = $request->validate([
            'type' => 'required|in:yandex,vk',
            'subtype' => 'required|in:created,added',
            'login' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'oauth_token' => 'nullable|string',
            'status' => 'required|in:active,archived,paused',
            'user_id' => 'required|exists:users,id',
            'balance' => 'required|numeric|min:0',
        ]);

        Log::info('Validated data for update:', $validated);

        $account->update($validated);

        Log::info('Updated account:', $account->toArray());

        return redirect()
            ->route('boss.accounts.index')
            ->with('success', 'Аккаунт успешно обновлен');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()
            ->route('boss.accounts.index')
            ->with('success', 'Аккаунт успешно удален');
    }
} 