<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'equipos',
            'user_equipo',
            'abilities',
            'roles',
            'assigned_roles',
            'permissions'
        ]);

        $this->call([
            BouncerSeeder::class,
            UsersTableSeeder::class
        ]);

    }

    public function truncateTables(array $tables = [])
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
