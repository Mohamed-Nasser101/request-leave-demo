<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'mohamed'
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

    }
}
