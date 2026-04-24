<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $roles = DB::table('users')
            ->select('role')
            ->whereNotNull('role')
            ->distinct()
            ->pluck('role');

        foreach ($roles as $oldRole) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => ucfirst($oldRole),
                'slug' => $oldRole,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')
                ->where('role', $oldRole)
                ->update(['role_id' => $roleId]);
        }
    }

    public function down(): void
    {
        //
    }
};
