<?php

namespace App\Exports;

use App\Models\PesertaKegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesertaExport implements FromCollection, WithHeadings
{
    protected $kegiatan_id;

    public function __construct($kegiatan_id)
    {
        $this->kegiatan_id = $kegiatan_id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PesertaKegiatan::where('kegiatan_id', $this->kegiatan_id)
            ->get([
                'nama_lengkap',
                'nip',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'agama',
                'pendidikan_terakhir',
                'jabatan',
                'pangkat_golongan',
                'unit_kerja',
                'alamat_kantor',
                'telp_kantor',
                'alamat_rumah',
                'telp_rumah',
                'alamat_email',
                'npwp',
                'peran',
                'surat_tugas',
                'tiket',
                'boarding_pass',
                'bukti_perjalanan',
                'sppd',
            ]);

        dd($data);

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIP',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Pendidikan Terakhir',
            'Jabatan',
            'Pangkat/Golongan',
            'Unit Kerja',
            'Alamat Kantor',
            'Telp Kantor',
            'Alamat Rumah',
            'Telp Rumah',
            'Alamat Email',
            'NPWP',
            'Peran',
            'Surat Tugas',
            'Tiket',
            'Boarding Pass',
            'Bukti Perjalanan',
            'SPPD',
        ];
    }
}
