<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        $admin->ownedTeams()->save(Team::forceCreate([
            'user_id' => $admin->id,
            'name' => explode(' ', $admin->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

        $admin->assignRole('admin');

        
        $cashier = User::firstOrCreate([
            'name' => 'Cashier',
            'email' => 'cashier@cashier.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        $cashier->ownedTeams()->save(Team::forceCreate([
            'user_id' => $cashier->id,
            'name' => explode(' ', $cashier->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

        $cashier->assignRole('cashier');


        $approver = User::firstOrCreate([
            'name' => 'Approver',
            'email' => 'approver@approver.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        $approver->ownedTeams()->save(Team::forceCreate([
            'user_id' => $approver->id,
            'name' => explode(' ', $approver->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

        $approver->assignRole('approving_officer');
    }
}
