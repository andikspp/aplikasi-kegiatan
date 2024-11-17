<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Seeder
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User Seeder
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kegiatan Seeder
        $kegiatanId = DB::table('kegiatans')->insertGetId([
            'nama' => 'Pelatihan Guru PAUD 2024',
            'role' => 'Pembelajaran',
            'tanggal_pendaftaran' => '2024-01-01',
            'selesai_pendaftaran' => '2024-01-15',
            'tanggal_kegiatan' => '2024-02-01',
            'tempat_kegiatan' => 'Aula PAUD Center',
            'jenis_kegiatan' => 'Pelatihan',
            'link_meeting' => 'https://meet.google.com/xyz',
            'jumlah_jp' => 32,
            'membutuhkan_mapel' => 'ya',
            'membutuhkan_nomor_rekening' => 'ya',
            'membutuhkan_lokasi' => 'ya',
            'membutuhkan_foto_presensi' => 'ya',
            'menggunakan_sertifikat' => 'ya',
            'nomor_sertifikat' => 'CERT/2024/001',
            'nomor_seri_sertifikat' => 'SER001',
            'template_sertifikat' => 'template1.pdf',
            'tanggal_ttd_sertifikat' => '2024-02-15',
            'butuh_mapel' => true,
            'butuh_rekening' => true,
            'butuh_lokasi' => true,
            'butuh_foto_presensi' => true,
            'gunakan_sertifikat' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Peran Kegiatan Seeder
        DB::table('peran_kegiatan')->insert([
            'id_kegiatan' => $kegiatanId,
            'peran' => 'Peserta',
            'nomor_rekening' => 'Ya',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Peserta Seeder
        DB::table('peserta')->insert([
            'kegiatan_id' => $kegiatanId,
            'nama_lengkap' => 'Jane Smith',
            'nip' => '198505152010012015',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1985-05-15',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Islam',
            'pendidikan_terakhir' => 'S1',
            'jabatan' => 'Guru PAUD',
            'pangkat_golongan' => 'III/a',
            'unit_kerja' => 'TK Ceria',
            'masa_kerja' => '5 tahun',
            'alamat_kantor' => 'Jl. Pendidikan No. 123',
            'telp_kantor' => '021-5550123',
            'alamat_rumah' => 'Jl. Melati No. 45',
            'telp_rumah' => '081234567890',
            'alamat_email' => 'jane.smith@email.com',
            'npwp' => '09.876.543.2-123.000',
            'peran' => 'Peserta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Quiz Seeder
        $quizId = DB::table('quizz')->insertGetId([
            'kegiatan_id' => $kegiatanId,
            'judul' => 'Evaluasi Pelatihan PAUD',
            'deskripsi' => 'Evaluasi pemahaman peserta tentang materi pelatihan',
            'tanggal_mulai' => '2024-02-01 13:00:00',
            'tanggal_selesai' => '2024-02-01 15:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal Seeder
        $soalId = DB::table('soal')->insertGetId([
            'quiz_id' => $quizId,
            'pertanyaan' => 'Apa yang dimaksud dengan PAUD holistik integratif?',
            'kategori_soal' => 'Pilihan Ganda',
            'wajib_diisi' => true,
            'deskripsi' => 'Pilih jawaban yang paling tepat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Opsi Jawaban Seeder
        DB::table('opsi_jawaban')->insert([
            [
                'soal_id' => $soalId,
                'jawaban' => 'Pendekatan pembelajaran yang menyeluruh dan terpadu',
                'is_true' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId,
                'jawaban' => 'Sistem pembelajaran konvensional',
                'is_true' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId,
                'jawaban' => 'Metode belajar sambil bermain',
                'is_true' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}