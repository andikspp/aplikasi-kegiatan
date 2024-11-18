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
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User Seeder
        $userId = DB::table('users')->insertGetId([
            'username' => 'user',
            'email' => 'user@example.com',
            'nama' => 'user',
            'password' => Hash::make('user'),
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
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addHours(2), 
            'total_point' => 100,
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal Seeder
        $soalId1 = DB::table('soal')->insertGetId([
            'quizz_id' => $quizId,
            'pertanyaan' => 'Apa yang dimaksud dengan PAUD holistik integratif?',
            'kategori_soal' => 'single_choice',
            'point' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $soalId2 = DB::table('soal')->insertGetId([
            'quizz_id' => $quizId,
            'pertanyaan' => 'Pilih komponen-komponen yang termasuk dalam PAUD holistik integratif:',
            'kategori_soal' => 'multiple_choice',
            'point' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $soalId3 = DB::table('soal')->insertGetId([
            'quizz_id' => $quizId,
            'pertanyaan' => 'Jelaskan pentingnya pendidikan inklusi dalam PAUD.',
            'kategori_soal' => 'essay',
            'point' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Opsi Jawaban Seeder
        DB::table('opsi_jawaban')->insert([
            // Options for soalId1
            [
                'soal_id' => $soalId1,
                'jawaban' => 'Pendekatan pembelajaran yang menyeluruh dan terpadu',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId1,
                'jawaban' => 'Sistem pembelajaran konvensional',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId1,
                'jawaban' => 'Metode belajar sambil bermain',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Options for soalId2
            [
                'soal_id' => $soalId2,
                'jawaban' => 'Pendidikan',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId2,
                'jawaban' => 'Kesehatan',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId2,
                'jawaban' => 'Gizi',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId2,
                'jawaban' => 'Pengasuhan',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId2,
                'jawaban' => 'Hiburan',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Quiz Attempts Seeder
        $attemptId = DB::table('quiz_attempt')->insertGetId([
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'status' => 'submitted',
            'score' => 20.00,
            'started_at' => '2024-02-01 13:30:00',
            'submitted_at' => '2024-02-01 14:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Quiz Answers Seeder
        DB::table('quiz_jawaban')->insert([
            'attempt_id' => $attemptId,
            'soal_id' => $soalId1,
            'jawaban' => 'Pendekatan pembelajaran yang menyeluruh dan terpadu',
            'is_correct' => true,
            'point_earned' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        $quizId2 = DB::table('quizz')->insertGetId([
            'kegiatan_id' => $kegiatanId,
            'judul' => 'Evaluasi Pelatihan SD',
            'deskripsi' => 'Evaluasi pemahaman peserta tentang materi pelatihan',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addHours(2), 
            'total_point' => 100,
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $soalId6 = DB::table('soal')->insertGetId([
            'quizz_id' => $quizId2,
            'pertanyaan' => 'Apa yang dimaksud dengan PAUD holistik integratif?',
            'kategori_soal' => 'single_choice',
            'point' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('opsi_jawaban')->insert([
            // Options for soalId6
            [
                'soal_id' => $soalId6,
                'jawaban' => 'Pendekatan pembelajaran yang menyeluruh dan terpadu',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId6,
                'jawaban' => 'Sistem pembelajaran konvensional',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'soal_id' => $soalId6,
                'jawaban' => 'Metode belajar sambil bermain',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
