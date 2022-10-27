<?php

namespace Database\Seeders;

use App\Models\Music;
use App\Models\User;
use Database\Factories\MusicFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Ole van der Heiden',
            'email' => '1034047@hr.nl',
            'rank' => true,
            'password' => bcrypt('test1234'),
            ]);
        \App\Models\User::factory()->create([
            'name' => 'Stefaan Test',
            'email' => 'test@test.com',
            'rank' => false,
            'password' => bcrypt('test1234'),
        ]);
        User::factory(10)->create()
            ->each(function ($user)
            {
                $user->music()->saveMany(Music::factory(10)
                    ->create(['user_id'=>$user->id]));
            });
    }
}
