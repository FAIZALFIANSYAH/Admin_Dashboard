<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dashboard;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'label' => 'Total Users',
                'value' => '1,250',
                'icon'  => 'users',
                'color' => 'info',
            ],
            [
                'label' => 'Sales Today',
                'value' => '542',
                'icon'  => 'shopping-cart',
                'color' => 'success',
            ],
            [
                'label' => 'New Messages',
                'value' => '15',
                'icon'  => 'envelope',
                'color' => 'warning',
            ],
            [
                'label' => 'Server Load',
                'value' => '42%',
                'icon'  => 'chart-pie',
                'color' => 'danger',
            ],
        ];

        foreach ($data as $item) {
            Dashboard::create($item);
        }
    }
}