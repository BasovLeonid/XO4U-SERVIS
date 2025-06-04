<?php

namespace App\Http\Controllers\Lk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('lk.projects.index');
    }

    public function create()
    {
        return view('lk.projects.create');
    }

    public function store(Request $request)
    {
        // Логика создания проекта
        return redirect()->route('lk.projects.index');
    }

    public function show($id)
    {
        return view('lk.projects.show', compact('id'));
    }

    public function edit($id)
    {
        return view('lk.projects.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Логика обновления проекта
        return redirect()->route('lk.projects.index');
    }

    public function destroy($id)
    {
        // Логика удаления проекта
        return redirect()->route('lk.projects.index');
    }
} 