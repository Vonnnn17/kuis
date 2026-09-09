<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada kategori yang sesuai topik knowledge
        $kategori1 = Kategori::firstOrCreate(
            ['nama' => 'Teknologi Informasi'],
            ['deskripsi' => 'Pengetahuan seputar pemrograman, infrastruktur IT, dan komputasi awan.']
        );

        $kategori2 = Kategori::firstOrCreate(
            ['nama' => 'Manajemen Proyek'],
            ['deskripsi' => 'Metodologi kerja seperti Agile, Scrum, dan manajemen waktu tim.']
        );

        $kategori3 = Kategori::firstOrCreate(
            ['nama' => 'Kesehatan & Gaya Hidup'],
            ['deskripsi' => 'Tips kesehatan kerja, ergonomi tempat kerja, dan nutrisi harian.']
        );

        $data = [
            [
                'kategori_id' => $kategori1->id,
                'judul' => 'Prinsip Dasar Arsitektur RESTful API',
                'ringkasan' => 'Panduan memahami statelessness, HTTP methods, dan konvensi status code dalam pembuatan RESTful API modern.',
                'isi' => "REST (Representational State Transfer) adalah gaya arsitektur perangkat lunak yang dirancang untuk memandu perancangan arsitektur web.\n\nBeberapa prinsip utama REST:\n1. Client-Server Architecture: Pemisahan tegas antara antarmuka pengguna dan logika backend.\n2. Stateless: Setiap permintaan dari client ke server harus mengandung semua informasi yang diperlukan untuk memahami dan memproses request tersebut.\n3. Cacheable: Respon harus secara eksplisit mendefinisikan dirinya dapat di-cache atau tidak.\n4. Uniform Interface: Penggunaan metode standar HTTP seperti GET (membaca), POST (membuat), PUT (mengubah total), PATCH (mengubah sebagian), dan DELETE (menghapus).\n\nPenerapan REST API yang konsisten mempermudah integrasi lintas platform.",
                'sumber' => 'https://restfulapi.net',
                'status' => 'published',
            ],
            [
                'kategori_id' => $kategori1->id,
                'judul' => 'Mengenal Konsep MVC pada Framework Modern',
                'ringkasan' => 'Penjelasan Model-View-Controller dalam memisahkan logika bisnis, antarmuka, dan rute navigasi aplikasi.',
                'isi' => "Model-View-Controller (MVC) adalah pola desain arsitektur yang membagi aplikasi menjadi tiga komponen utama:\n\n- Model: Mengelola data, aturan logika bisnis, dan interaksi dengan database (misalnya Eloquent ORM di Laravel).\n- View: Bertanggung jawab merender antarmuka pengguna (UI) kepada pengguna (misalnya Blade template engine).\n- Controller: Menerima input dari pengguna, berinteraksi dengan Model, dan memilih View yang sesuai untuk dikembalikan.\n\nDengan MVC, kode menjadi jauh lebih terstruktur, mudah diuji, dan modular.",
                'sumber' => 'Dokumentasi Arsitektur Web',
                'status' => 'published',
            ],
            [
                'kategori_id' => $kategori2->id,
                'judul' => 'Penerapan Metodologi Scrum untuk Tim Pengembang Perangkat Lunak',
                'ringkasan' => 'Langkah praktis menerapkan sprint harian, backlog grooming, dan retrospective untuk meningkatkan produktivitas tim.',
                'isi' => "Scrum adalah salah satu kerangka kerja Agile yang paling populer. Fokus utamanya adalah kolaborasi erat, pengiriman berkala bernilai tinggi, dan fleksibilitas menghadapi perubahan.\n\nKomponen penting dalam Scrum:\n1. Product Owner: Menentukan prioritas fitur dari sudut pandang bisnis.\n2. Scrum Master: Memfasilitasi proses dan menyingkirkan hambatan tim.\n3. Development Team: Tim lintas fungsi yang mewujudkan fitur dalam sprint 1-4 minggu.\n4. Sprint Retrospective: Refleksi di akhir siklus untuk perbaikan terus-menerus.",
                'sumber' => 'Scrum Guide 2020',
                'status' => 'published',
            ],
            [
                'kategori_id' => $kategori3->id,
                'judul' => 'Panduan Ergonomi Kerja di Depan Komputer untuk Mencegah RSI',
                'ringkasan' => 'Tips posisi duduk, sudut pandang monitor, dan aturan 20-20-20 untuk menjaga kesehatan penglihatan dan tulang belakang.',
                'isi' => "Bekerja di depan layar dalam durasi lama rentan menimbulkan Repetitive Strain Injury (RSI) dan Computer Vision Syndrome.\n\nLangkah pencegahan:\n1. Posisikan monitor sejajar dengan mata, berjarak sekitar satu lengan panjang.\n2. Gunakan kursi dengan penopang pinggang (lumbar support) dan telapak kaki menapak rata di lantai.\n3. Terapkan aturan 20-20-20: Setiap 20 menit menatap layar, istirahatkan mata dengan melihat objek sejauh 20 kaki (6 meter) selama 20 detik.\n4. Rutin melakukan peregangan pergelangan tangan dan leher setiap 1-2 jam.",
                'sumber' => 'Kementerian Kesehatan RI - Pedoman Ergonomi Kerja',
                'status' => 'published',
            ],
            [
                'kategori_id' => $kategori1->id,
                'judul' => '[DRAFT] Panduan Keamanan Web: Mencegah SQL Injection dan XSS',
                'ringkasan' => 'Draf materi keamanan aplikasi web mengenai validasi input, prepared statements, dan sanitasi data Blade.',
                'isi' => "Dokumen ini masih dalam tahap penyusunan oleh tim IT Security.\n\nTopik yang sedang dirangkum:\n- Penggunaan Parameterized Queries / Eloquent ORM untuk menangkal SQL Injection.\n- Escaping otomatis di Blade via {{ }} untuk menangkal Cross-Site Scripting (XSS).\n- Penerapan CSRF Token di seluruh form POST/PUT/DELETE.\n- Rate limiting pada endpoint autentikasi.",
                'sumber' => 'OWASP Top 10 Security Risks',
                'status' => 'draft',
            ],
        ];

        foreach ($data as $item) {
            Informasi::firstOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
