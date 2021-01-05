<?php

use App\Role;
use App\Site;
use App\Status;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Role::create([
            'name' => 'Administrator'
        ]);
        Role::create([
            'name' => 'Member'
        ]);
        Status::create([
            'name' => 'Active'
        ]);
        Status::create([
            'name' => 'Inactive'
        ]);

        $sites = ['Smart City' => 'smart', 'EZ Pay' => 'ezpay', 'Sinaoo' => 'sinao', 'Tebar Benih' => 'tebar', 'Cilik' => 'cilik', 'T&D Jogja' => 'jogja'];
        foreach($sites as $sit => $site){
            Site::create([
                'name' => $sit,
                'description' => $site
            ]);
        }

        User::create([
            'name' => 'Admin',
            'last_name' => 'Smart City',
            'password' => Hash::make('password'),
            'email' => 'admin@smartcity.id',
            'role_id' => 1,
            'site_id' => 1
        ]);


    }
}
