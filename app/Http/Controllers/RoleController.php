<?php

use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Show a list of roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Show form for creating a new role
    public function create()
    {
        $menus = Menu::all(); // Fetch all menus
        return view('roles.create', compact('menus'));
    }

    // Store a new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'menus' => 'array', // Menus can be an array
            'menus.*' => 'exists:menus,id', // Ensure all selected menus exist
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        // Attach the selected menus to the role
        if ($request->has('menus')) {
            $role->menus()->sync($request->menus);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Show the form for editing a role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $menus = Menu::all();
        return view('roles.edit', compact('role', 'menus'));
    }

    // Update an existing role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'menus' => 'array',
            'menus.*' => 'exists:menus,id',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        // Sync the selected menus with the role
        if ($request->has('menus')) {
            $role->menus()->sync($request->menus);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Delete a role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
