<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopian4ji@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'rizkymuhamad',
            'email' => 'rizkymuhamad@gmail.com',
            'role' => '2',
            'status' => 1,
            'hp' => '081234567777',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Misbah Munir',
            'email' => 'misbahul@gmail.com',
            'role' => '2',
            'status' => 0,
            'hp' => '081234162738',
            'password' => bcrypt('12345'),
        ]);
        #data kategori 
        Kategori::create([
            'nama_kategori' => 'Brownies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Combro',
        ]);
        Kategori::create([
            'nama_kategori' => 'Dawet',
        ]);
        Kategori::create([
            'nama_kategori' => 'Mochi',
        ]);
        Kategori::create([
            'nama_kategori' => 'Wingko',
        ]);
    }
}
