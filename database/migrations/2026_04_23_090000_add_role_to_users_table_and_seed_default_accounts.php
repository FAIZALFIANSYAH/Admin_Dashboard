<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default(User::ROLE_MANAGER_2)->after('email');
        });

        DB::table('users')->whereNull('email_verified_at')->update([
            'email_verified_at' => now(),
        ]);

        DB::table('users')->update([
            'role' => User::ROLE_MANAGER_2,
        ]);

        $this->upsertUser(
            'Superadmin',
            'muhfaiza206@gmail.com',
            User::ROLE_SUPERADMIN,
            '2062008@dmin'
        );

        $this->upsertUser(
            'Manager 1',
            'manager1@gmail.com',
            User::ROLE_MANAGER_1,
            'managertext'
        );

        $this->upsertUser(
            'Manager 2',
            'manager2@gmail.com',
            User::ROLE_MANAGER_2,
            'managerimg'
        );
    }

    public function down(): void
    {
        DB::table('users')->whereIn('email', [
            'muhfaiza206@gmail.com',
            'manager1@gmail.com',
            'manager2@gmail.com',
        ])->delete();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    private function upsertUser(string $name, string $email, string $role, string $password): void
    {
        $existingUser = DB::table('users')->where('email', $email)->first();

        $payload = [
            'name' => $name,
            'role' => $role,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'updated_at' => now(),
        ];

        if ($existingUser) {
            DB::table('users')->where('id', $existingUser->id)->update($payload);
            return;
        }

        DB::table('users')->insert($payload + [
            'email' => $email,
            'created_at' => now(),
        ]);
    }
};
