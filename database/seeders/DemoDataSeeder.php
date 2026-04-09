<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin CDB',
            'email' => 'admin@cahayadimensibumi.com',
            'password' => Hash::make('password123'),
        ]);

        // Create demo projects
        $projects = [
            [
                'company_name' => 'PT Mall Indonesia',
                'location' => 'Jakarta Pusat',
                'description' => 'Instalasi pintu otomatis dormakaba untuk mall besar di Jakarta. Pekerjaan meliputi 12 unit pintu geser otomatis dan 4 unit pintu revolving.',
                'cover_image' => '',
                'is_active' => true,
            ],
            [
                'company_name' => 'RS Harapan Sehat',
                'location' => 'Tangerang',
                'description' => 'Renovasi dan pemasangan automatic doors untuk rumah sakit tipe A. Termasuk 8 unit hermetic doors untuk ruang operasi dan ICU.',
                'cover_image' => '',
                'is_active' => true,
            ],
            [
                'company_name' => 'PT Gedung Perkantoran',
                'location' => 'Jakarta Selatan',
                'description' => 'General construction untuk gedung perkantoran 15 lantai. Scope pekerjaan meliputi struktur, MEP, dan finishing.',
                'cover_image' => '',
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Create demo blogs
        $blogs = [
            [
                'title' => 'Keunggulan Pintu Otomatis dormakaba untuk Gedung Komersial',
                'slug' => 'keunggulan-pintu-otomatis-dormakaba',
                'excerpt' => 'Pintu otomatis dormakaba menawarkan solusi terbaik untuk gedung komersial dengan teknologi canggih dan desain modern.',
                'content' => 'Pintu otomatis dormakaba adalah pilihan terbaik untuk gedung komersial modern. Dengan teknologi sensor canggih dan desain yang elegan, produk kami memberikan kenyamanan dan keamanan maksimal.\n\nKeunggulan utama:\n- Teknologi sensor inframerah terbaru\n- Konsumsi energi rendah\n- Desain minimalis dan modern\n- Sistem keamanan terintegrasi\n- Mudah dioperasikan\n\nHubungi kami untuk informasi lebih lanjut mengenai produk dan instalasi pintu otomatis dormakaba.',
                'featured_image' => '',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Tips Memilih General Kontraktor yang Tepat',
                'slug' => 'tips-memilih-general-kontraktor',
                'excerpt' => 'Panduan lengkap dalam memilih general kontraktor untuk proyek konstruksi Anda.',
                'content' => 'Memilih general kontraktor yang tepat adalah keputusan penting dalam keberhasilan proyek konstruksi Anda. Berikut beberapa tips yang perlu diperhatikan:\n\n1. Pengalaman dan Track Record\nPastikan kontraktor memiliki pengalaman yang cukup dan track record yang baik.\n\n2. Lisensi dan Sertifikasi\nPeriksa apakah kontraktor memiliki lisensi dan sertifikasi yang diperlukan.\n\n3. Portofolio Proyek\nLihat proyek-proyek yang telah diselesaikan sebelumnya.\n\n4. Tim Profesional\nPastikan kontraktor memiliki tim profesional dan berpengalaman.\n\n5. Harga Kompetitif\nDapatkan penawaran dari beberapa kontraktor dan bandingkan.\n\nPT Cahaya Dimensi Bumi siap menjadi partner terpercaya Anda untuk semua kebutuhan konstruksi.',
                'featured_image' => '',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
