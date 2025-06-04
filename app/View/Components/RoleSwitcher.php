<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class RoleSwitcher extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.role-switcher');
    }
}
