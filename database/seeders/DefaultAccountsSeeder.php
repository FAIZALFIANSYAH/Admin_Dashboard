<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            ['name' => 'dashboard.index', 'display_name' => 'Dashboard', 'description' => 'Melihat ringkasan data portfolio.', 'group_name' => 'General'],
            ['name' => 'dashboard.view', 'display_name' => 'Dashboard View', 'description' => 'Melihat dashboard utama.', 'group_name' => 'General'],
            ['name' => 'hero.index', 'display_name' => 'Hero Section', 'description' => 'Mengelola hero section dan gambar utama.', 'group_name' => 'Portfolio Content'],
            ['name' => 'about.index', 'display_name' => 'About Description', 'description' => 'Mengelola deskripsi about me.', 'group_name' => 'Portfolio Content'],
            ['name' => 'expertise.index', 'display_name' => 'Learning / Expertises', 'description' => 'Mengelola daftar expertise.', 'group_name' => 'Portfolio Content'],
            ['name' => 'tools.index', 'display_name' => 'Tools', 'description' => 'Mengelola daftar tools.', 'group_name' => 'Portfolio Content'],
            ['name' => 'experience.index', 'display_name' => 'Career Narrative', 'description' => 'Mengelola pengalaman dan narasi karier.', 'group_name' => 'Portfolio Content'],
            ['name' => 'project.index', 'display_name' => 'My Projects', 'description' => 'Mengelola project portfolio utama.', 'group_name' => 'Portfolio Media'],
            ['name' => 'video.index', 'display_name' => 'Video Projects', 'description' => 'Mengelola video project.', 'group_name' => 'Portfolio Media'],
            ['name' => 'contact.index', 'display_name' => 'Contact Settings', 'description' => 'Mengelola email kontak dan social links.', 'group_name' => 'Portfolio Media'],
            ['name' => 'products.index', 'display_name' => 'Products', 'description' => 'Mengelola modul products bawaan project.', 'group_name' => 'Additional Modules'],
            ['name' => 'users.index', 'display_name' => 'Manage Users', 'description' => 'Mengelola user dan role.', 'group_name' => 'Administration'],
            ['name' => 'roles.index', 'display_name' => 'Manage Roles', 'description' => 'Mengelola role dan permission.', 'group_name' => 'Administration'],
            ['name' => 'roles.create', 'display_name' => 'Create Role', 'description' => 'Membuat role baru.', 'group_name' => 'Administration'],
            ['name' => 'roles.edit', 'display_name' => 'Edit Role', 'description' => 'Mengubah role.', 'group_name' => 'Administration'],
            ['name' => 'roles.store', 'display_name' => 'Store Role', 'description' => 'Menyimpan role baru.', 'group_name' => 'Administration'],
            ['name' => 'roles.update', 'display_name' => 'Update Role', 'description' => 'Memperbarui role.', 'group_name' => 'Administration'],
            ['name' => 'roles.destroy', 'display_name' => 'Delete Role', 'description' => 'Menghapus role.', 'group_name' => 'Administration'],
        ])->mapWithKeys(function (array $permission): array {
            return [
                $permission['name'] => Permission::updateOrCreate(
                    ['name' => $permission['name'], 'guard_name' => 'web'],
                    $permission
                ),
            ];
        });

        $roles = [
            'superadmin' => ['superadmin', $permissions->keys()->all()],
            'manager1' => ['manager1', ['hero', 'about', 'expertise', 'tools', 'experience']],
            'manager2' => ['manager2', ['dashboard', 'project']],
        ];

        foreach ($roles as $slug => [$name, $permissionNames]) {
            $role = Role::updateOrCreate(
                ['slug' => $slug, 'guard_name' => 'web'],
                ['name' => $name]
            );

            $role->syncPermissions($permissionNames);
        }

        $this->createDefaultAccount(
            'Superadmin',
            'muhfaiza206@gmail.com',
            'superadmin',
            '2062008@dmin'
        );

        $this->createDefaultAccount(
            'Manager 1',
            'manager1@gmail.com',
            'manager1',
            'managertext'
        );

        $this->createDefaultAccount(
            'Manager 2',
            'manager2@gmail.com',
            'manager2',
            'managerimg'
        );
    }

    private function createDefaultAccount(string $name, string $email, string $role, string $password): void
    {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        $user->syncRoles([$role]);
    }
}
