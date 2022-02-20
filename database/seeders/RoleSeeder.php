<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'        => 'Administrator',
                'slug'        => Str::slug('Administrator'),
                'permission'  => '["read", "create", "update", "delete"]',
                'description' => 'Los usuarios administradores pueden realizar cualquier acción.',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]
        ]);

        DB::table('roles')->insert([
            [
                'name'        => 'Editor',
                'slug'        => Str::slug('Editor'),
                'permission'  => '["read", "create", "update"]',
                'description' => 'Este tipo de usuarios tienen la capacidad de leer, crear y actualizar.',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ]
        ]);
    }
}
