<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class DefaltAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();
        Admin::create([
            'name'=>'mariam',
            'email'=>'mariam@gmail.com',
            'password'=>bcrypt('12345678'),
            'photo'=>'1.jpg',
        ]);
      
    }
}
