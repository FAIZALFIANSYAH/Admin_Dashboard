<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $roles = [
            User::ROLE_SUPERADMIN => [
                'name' => 'Superadmin',
                'permissions' => User::defaultPermissionsForRole(User::ROLE_SUPERADMIN),
            ],
            User::ROLE_MANAGER_1 => [
                'name' => 'Manager 1',
                'permissions' => User::defaultPermissionsForRole(User::ROLE_MANAGER_1),
            ],
            User::ROLE_MANAGER_2 => [
                'name' => 'Manager 2',
                'permissions' => User::defaultPermissionsForRole(User::ROLE_MANAGER_2),
            ],
        ];

        foreach ($roles as $slug => $role) {
            $existingRole = DB::table('roles')->where('slug', $slug)->first();

            if ($existingRole) {
                DB::table('roles')->where('id', $existingRole->id)->update([
                    'name' => $role['name'],
                    'permissions' => json_encode($role['permissions']),
                    'updated_at' => now(),
                ]);
                $roleId = $existingRole->id;
            } else {
                $roleId = DB::table('roles')->insertGetId([
                    'name' => $role['name'],
                    'slug' => $slug,
                    'permissions' => json_encode($role['permissions']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('users')
                ->where('role', $slug)
                ->orWhere(function ($query) use ($roleId) {
                    $query->whereNull('role')->where('role_id', $roleId);
                })
                ->update([
                    'role' => $slug,
                    'role_id' => $roleId,
                ]);
        }
    }

    public function down(): void
    {
        //
    }
};
