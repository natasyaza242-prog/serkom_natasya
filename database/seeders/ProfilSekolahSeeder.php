<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilSekolah::create([
            'nama_sekolah' => 'SMKN 2 Tasikmalaya',
            'kepala_sekolah' => 'KURNIAWAN, S.Pd., M.Pd.',
            'foto' => 'gedung_sekolah.jpg',
            'logo' => 'logo_sekolah.png',
            'npsn' => '20210890',
            'alamat' => 'Jl. Noenoeng Tisnasaputra No.2, Kahuripan, Kec. Tawang, Kab. Tasikmalaya, Jawa Barat 46115',
            'kontak' => '081234567890',
            'visi_misi' => "Visi:\nMewujudkan lulusan yang kompeten, berakhlak mulia, berjiwa wirausaha, dan siap bersaing di tingkat nasional dan global.\n\nMisi:\n1. Menyelenggarakan pembelajaran berkualitas berbasis industri dan teknologi terkini.\n2. Menanamkan nilai religius, integritas, dan disiplin tinggi pada seluruh warga sekolah.\n3. Mengembangkan kemitraan strategis dengan dunia usaha dan industri.",
            'tahun_berdiri' => 2000,
            'deskripsi' => 'SMK Negeri 2 Tasikmalaya dulunya adalah sebuah Sekolah Teknik Menengah namun sekarang telah berubah menjadi Sekolah Menengah Kejuruan yang termasuk dalam kelompok Teknologi dan Industri.',
        ]);
    }
}
