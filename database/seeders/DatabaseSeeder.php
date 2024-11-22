<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'tanggal_pendaftaran' => '2024-11-01',
                'selesai_pendaftaran' => '2024-11-10',
                'tanggal_kegiatan' => '2024-11-15',
                'tempat_kegiatan' => 'Jakarta',
                'jenis_kegiatan' => 'Seminar',
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
                'tanggal_pendaftaran' => '2024-11-01',
                'selesai_pendaftaran' => '2024-11-10',
                'tanggal_kegiatan' => '2024-11-15',
                'tempat_kegiatan' => 'Jakarta',
                'jenis_kegiatan' => 'Seminar',
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

        // Seed Peserta
        DB::table('peserta')->insert([
            [
                'user_id' => 1,
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
                'masa_kerja' => '5 tahun',
                'alamat_kantor' => 'Jl. Sudirman No.1',
                'telp_kantor' => '021123456',
                'alamat_rumah' => 'Jl. Merdeka No.2',
                'telp_rumah' => '021654321',
                'alamat_email' => 'john.doe@example.com',
                'npwp' => '987654321',
                'peran' => 'Peserta',
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
                'masa_kerja' => '5 tahun',
                'alamat_kantor' => 'Jl. Sudirman No.1',
                'telp_kantor' => '021123456',
                'alamat_rumah' => 'Jl. Merdeka No.2',
                'telp_rumah' => '021654321',
                'alamat_email' => 'test@gmail.com',
                'npwp' => '987654321',
                'peran' => 'Peserta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
