<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
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

        User::factory()->create([
            'name' => 'mohamed',
            'email' => 'm@m.com',
        ]);
        User::factory(2)->create();

        Role::create([
            'name' => 'manager'
        ]);

        Ability::create([
            'name' => 'accept-request'
        ]);

        Role::find(1)->allowTo('accept-request');
        
        User::find(1)->assignRole('manager');

        DB::table('leave_type')->insert([
            'name' => 'annual'
        ]);
        DB::table('leave_type')->insert([
            'name' => 'sick'
        ]);
        DB::table('leave_type')->insert([
            'name' => 'urgent'
        ]);

        
        DB::table('leave_status')->insert([
            'name' => 'approved'
        ]);
        DB::table('leave_status')->insert([
            'name' => 'refused'
        ]);
        DB::table('leave_status')->insert([
            'name' => 'pending'
        ]);

    }
}
