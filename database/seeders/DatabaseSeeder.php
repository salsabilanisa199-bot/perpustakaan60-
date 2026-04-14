<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        \App\Models\User::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // Create Siswa
        $siswaUser = \App\Models\User::create([
            'username' => 'Annisa',
            'password' => bcrypt('annisa123'),
            'role' => 'siswa'
        ]);

        \App\Models\Anggota::create([
            'nama' => 'Annisa',
            'kelas' => 'XII RPL 2',
            'alamat' => 'Jl. Cempaka Putih No. 12',
            'no_telp' => '085717652693',
            'user_id' => $siswaUser->id
        ]);

        // Create Default Book
        \App\Models\Buku::create([
            'judul' => 'Belajar Pemrograman Laravel 10',
            'pengarang' => 'Budi S.',
            'penerbit' => 'Informatika',
            'tahun_terbit' => 2023,
            'stok' => 5
        ]);
    }
}
