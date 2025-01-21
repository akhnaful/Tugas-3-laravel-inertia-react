<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function setupPermissions()
    {
        // Membuat peran admin
        $adminRole = Role::create(['name' => 'admin']);

        // Membuat izin
        $permissions = ['manage users', 'manage posts', 'manage user violations', 'community statistics and activities'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Memberikan izin ke peran admin
        $adminRole->syncPermissions($permissions);

        // Memberikan peran admin ke pengguna
        $user = User::find(1); // Gantilah ID dengan ID pengguna yang ingin Anda jadikan admin
        $user->assignRole('admin');

        return "Permissions and roles setup completed.";
    }

    public function checkPermissions(User $user)
    {
        if ($user->hasRole('admin')) {
            echo "User is an admin.";
        }

        if ($user->can('manage users')) {
            echo "User can manage users.";
        }
        if ($user->can('manage user violations')) {
            echo "User can manage user violations.";
        }
        if ($user->can('community statistics and activities')) {
            echo "User can see community statistics and activities.";
        }
    }
}
