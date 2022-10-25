<?php

namespace Database\Seeders;

use App\Models\MusicCreater;
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
            ]);
        \App\Models\User::factory(10)->create();
    }
}
