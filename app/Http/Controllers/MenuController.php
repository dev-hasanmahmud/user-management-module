<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Display a list of menus
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->get();
        return view('menus.index', compact('menus'));
    }

    // Show the form for creating a new menu
    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->get(); // For selecting a parent menu
        return view('menus.create', compact('parentMenus'));
    }

    // Store a newly created menu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        Menu::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    // Show the form for editing the specified menu
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')->get(); // For selecting a parent menu
        return view('menus.edit', compact('menu', 'parentMenus'));
    }

    // Update the specified menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug,' . $menu->id,
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $menu->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    // Remove the specified menu
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
