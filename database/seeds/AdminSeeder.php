<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'id' => '1',
            'email' => 'info@sankalp.com',
            'password' => bcrypt('sankalp@2022'),
            'name' => 'Admin'
        ]);
    }
}
