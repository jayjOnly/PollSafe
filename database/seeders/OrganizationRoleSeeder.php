<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organization_roles')->insert([
            ['role' => 'Leader', 'created_at' => new DateTime()],
            ['role' => 'Treasurer', 'created_at' => new DateTime()],
            ['role' => 'Secretary', 'created_at' => new DateTime()],
            ['role' => 'Member', 'created_at' => new DateTime()],
        ]);
    }
}
