<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Correctly import the Hash facade

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'login' => 'igor',
            'nome' => 'Igor',
            'sobrenome' => 'Marques',
            'email' => 'soigormarques@gmail.com',
            'password' => Hash::make('igor4321'), // Correct usage of Hash facade
            'ativo' => "Sim",
            'acesso' => 'Admin',
        ]);
    }
}
