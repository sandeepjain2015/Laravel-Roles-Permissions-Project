<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
 use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class PermissionController extends Controller implements HasMiddleware
{
     public static function middleware(){
        return [
            new Middleware( 'permission:view permissions',only: ['index'] ),
            new Middleware( 'permission:edit permissions',only: ['edit'] ),
            new Middleware( 'permission:create permissions',only: ['create', 'store'] ),
            new Middleware( 'permission:delete permissions',only: ['destroy'] ),
            new Middleware( 'permission:show permissions',only: ['show'] ),
            new Middleware( 'permission:update permissions',only: ['update'] ),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Assuming you have a Permission model
        $permissions = Permission::paginate(50);

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        // Assuming you have a Permission model
        Permission::create([
            'name' => $request->name,
            
           
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the permission
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // dd($request->id);
        try {
            $permission = Permission::find($request->id);
if( $permission === null) {
                return redirect()->route('permissions.index')->with('error', 'Permission not found.');
            }
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
                    dd($e->getMessage(), $e->getTraceAsString());

        }
    }
}
