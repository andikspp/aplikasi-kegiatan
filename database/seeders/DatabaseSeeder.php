<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('pokjas')->insert([
            [
                'name' => 'Kemitraan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Publikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tata Kelola',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembelajaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tata Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // Seed Admins
        DB::table('admins')->insert([
            [
                'username' => 'admin_kemitraan',
                'pokja_id' => 1,
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin_tatakelola',
                'pokja_id' => 3,
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin_pembelajaran',
                'pokja_id' => 4,
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin_publikasi',
                'pokja_id' => 2,
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin_tatausaha',
                'pokja_id' => 5,
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'superadmin',
                'pokja_id' => null,
                'role' => 'superadmin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Users
        DB::table('users')->insert([
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'nip' => '123456',
                'password' => Hash::make('user'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Kegiatans
        DB::table('kegiatans')->insert([
            [
                'nama' => 'Kegiatan Kemitraan',
                'pokja_id' => 1,
                'tanggal_pendaftaran' => now()->subDay(),
                'selesai_pendaftaran' => now()->addDay(),
                'tanggal_kegiatan' => '2024-11-26',
                'selesai_kegiatan' => '2024-11-30',
                'tempat_kegiatan' => 'Jakarta',
                'jenis_kegiatan' => 'Luring',
                'link_meeting' => null,
                'jumlah_jp' => 5,
                'membutuhkan_mapel' => 'ya',
                'membutuhkan_nomor_rekening' => 'tidak',
                'membutuhkan_lokasi' => 'tidak',
                'membutuhkan_foto_presensi' => 'ya',
                'menggunakan_sertifikat' => 'ya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kegiatan Tata Kelola',
                'pokja_id' => 3,
                'tanggal_pendaftaran' => now()->subDay(),
                'selesai_pendaftaran' => now()->addDay(),
                'tanggal_kegiatan' => '2024-11-26',
                'selesai_kegiatan' => '2024-11-30',
                'tempat_kegiatan' => 'Jakarta',
                'jenis_kegiatan' => 'Daring',
                'link_meeting' => null,
                'jumlah_jp' => 5,
                'membutuhkan_mapel' => 'ya',
                'membutuhkan_nomor_rekening' => 'tidak',
                'membutuhkan_lokasi' => 'tidak',
                'membutuhkan_foto_presensi' => 'ya',
                'menggunakan_sertifikat' => 'ya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Quizz
        DB::table('quizz')->insert([
            [
                'kegiatan_id' => 1,
                'judul' => 'Quiz 1',
                'deskripsi' => 'Quiz for Workshop Guru',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(1),
                'total_point' => 100,
                'is_published' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Soal
        DB::table('soal')->insert([
            [
                'quiz_id' => 1,
                'pertanyaan' => 'What is the purpose of this workshop?',
                'kategori_soal' => 'Understanding',
                'wajib_diisi' => 1,
                'point' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Peran Kegiatan
        DB::table('peran_kegiatan')->insert([
            [
                'id_kegiatan' => 1,
                'peran' => 'Pembicara',
                'jumlah_peserta' => 1,
                'nomor_rekening' => 'Tidak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('peserta_kegiatan')->insert([
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'John Doe',
                'nip' => '123456',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'pendidikan_terakhir' => 'S1',
                'jabatan' => 'Guru',
                'unit_kerja' => 'SDN 1 Jakarta',
                'alamat_kantor' => 'Jl. Sudirman No.1',
                'telp_kantor' => '021123456',
                'alamat_rumah' => 'Jl. Merdeka No.2',
                'telp_rumah' => '021654321',
                'alamat_email' => 'test@gmail.com',
                'npwp' => '987654321',
                'peran' => 'Peserta',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'Jane Smith',
                'nip' => '234567',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-05-15',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'pendidikan_terakhir' => 'S2',
                'jabatan' => 'Dosen',
                'unit_kerja' => 'Universitas ABC',
                'alamat_kantor' => 'Jl. Merdeka No.3',
                'telp_kantor' => '022765432',
                'alamat_rumah' => 'Jl. Raya No.5',
                'telp_rumah' => '022543210',
                'alamat_email' => 'jane.smith@gmail.com',
                'npwp' => '123456789',
                'peran' => 'Pemateri',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'Ahmad Zaki',
                'nip' => '345678',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1992-02-20',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'pendidikan_terakhir' => 'S1',
                'jabatan' => 'Asisten Dosen',
                'unit_kerja' => 'Universitas XYZ',
                'alamat_kantor' => 'Jl. Raya No.7',
                'telp_kantor' => '031987654',
                'alamat_rumah' => 'Jl. Merpati No.8',
                'telp_rumah' => '031876543',
                'alamat_email' => 'ahmad.zaki@gmail.com',
                'npwp' => '234567890',
                'peran' => 'Peserta',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'Siti Mariam',
                'nip' => '456789',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1993-08-25',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'pendidikan_terakhir' => 'S1',
                'jabatan' => 'Guru',
                'unit_kerja' => 'SMPN 2 Yogyakarta',
                'alamat_kantor' => 'Jl. Malioboro No.9',
                'telp_kantor' => '027487654',
                'alamat_rumah' => 'Jl. Selamet No.10',
                'telp_rumah' => '027476543',
                'alamat_email' => 'siti.mariam@gmail.com',
                'npwp' => '345678901',
                'peran' => 'Peserta',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'Dedi Pratama',
                'nip' => '567890',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1987-03-10',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Kristen',
                'pendidikan_terakhir' => 'S2',
                'jabatan' => 'Peneliti',
                'unit_kerja' => 'LIPI',
                'alamat_kantor' => 'Jl. Gatot Subroto No.4',
                'telp_kantor' => '061123456',
                'alamat_rumah' => 'Jl. Sukarno Hatta No.6',
                'telp_rumah' => '061987654',
                'alamat_email' => 'dedi.pratama@gmail.com',
                'npwp' => '456789012',
                'peran' => 'Pemateri',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kegiatan_id' => 1,
                'nama_lengkap' => 'Ayu Lestari',
                'nip' => '678901',
                'tempat_lahir' => 'Bali',
                'tanggal_lahir' => '1995-11-30',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Hindu',
                'pendidikan_terakhir' => 'S1',
                'jabatan' => 'Staf Administrasi',
                'unit_kerja' => 'Pemprov Bali',
                'alamat_kantor' => 'Jl. Dewi No.11',
                'telp_kantor' => '036112233',
                'alamat_rumah' => 'Jl. Pantai No.12',
                'telp_rumah' => '036112244',
                'alamat_email' => 'ayu.lestari@gmail.com',
                'npwp' => '567890123',
                'peran' => 'Peserta',
                'signature' => 'storage/ttd/signature_1732662179.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
