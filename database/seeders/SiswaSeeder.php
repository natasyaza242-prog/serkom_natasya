<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            [
                'nisn' => '0071234501',
                'nama_siswa' => 'Natasya Juliana Azhari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024
            ],
            [
                'nisn' => '0071234502',
                'nama_siswa' => 'Nabila',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
            ],
            [
                'nisn' => '0071234503',
                'nama_siswa' => 'Alya Yulianti',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
            ],
            [
                'nisn' => '0071234504',
                'nama_siswa' => 'Ryan Maulana',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => 2023,
            ],
            [
                'nisn' => '0071234505',
                'nama_siswa' => 'Nifa Faridah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
            ],
            [
                'nisn' => '0071234506',
                'nama_siswa' => 'Dimas Pangestu',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => 2023,
            ],
            [
                'nisn' => '0081234507',
                'nama_siswa' => 'Syifa Nur Amanah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2025,
            ],
            [
                'nisn' => '0081234508',
                'nama_siswa' => 'Muhammad Al Rizky',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => 2022,
            ],
            [
                'nisn' => '0081234509',
                'nama_siswa' => 'Tiara Pratama',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2025,
            ],
            [
                'nisn' => '0081234510',
                'nama_siswa' => 'Putri Sabrina',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2026,
            ],
            [
                'nisn' => '0081234512',
                'nama_siswa' => 'Rizki Aditya',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => 2026,
            ],
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }
    }
}
