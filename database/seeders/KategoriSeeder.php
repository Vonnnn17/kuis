<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Teknologi Informasi', 'deskripsi' => 'Materi seputar software, jaringan, aplikasi, dan sistem digital.'],
            ['nama' => 'Manajemen Proyek', 'deskripsi' => 'Pengetahuan tentang perencanaan, koordinasi, dan evaluasi kerja tim.'],
            ['nama' => 'Kesehatan & Kerja', 'deskripsi' => 'Tips kesehatan, ergonomi, dan produktivitas kerja yang sehat.'],
            ['nama' => 'Bisnis Digital', 'deskripsi' => 'Strategi pemasaran dan pengelolaan bisnis berbasis digital.'],
        ];

        foreach ($data as $item) {
            DB::table('kategoris')->updateOrInsert(
                ['nama' => $item['nama']],
                $item
            );
        }
    }
}
