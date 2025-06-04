@if (Auth::check())
    <div style="position: fixed; top: 10px; right: 10px; z-index: 9999; background: #333; color: white; padding: 10px; border-radius: 6px;">
        <form method="POST" action="{{ route('debug.switch-role') }}">
            @csrf
            <div>
                <strong>Текущая роль:</strong> {{ Auth::user()->role }}
            </div>
            <select name="role" onchange="this.form.submit()">
                <option value="user" @selected(Auth::user()->role === 'user')>User</option>
                <option value="admin" @selected(Auth::user()->role === 'admin')>Admin</option>
            </select>
        </form>
    </div>
@endif
