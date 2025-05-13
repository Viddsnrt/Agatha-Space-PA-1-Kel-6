<?php

namespace App\Exports; // Namespace sudah benar

use App\Models\KritikSaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KritikSaranExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KritikSaran::latest()->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'No HP',
            'Jenis',
            'Pesan',
            'Tampilkan di Web?',
            'Tanggal Dibuat',
        ];
    }

    /**
    * @param KritikSaran $kritiksaran
    * @return array
    */
    public function map($kritiksaran): array
    {
        return [
            $kritiksaran->id,
            $kritiksaran->nama,
            $kritiksaran->email,
            $kritiksaran->no_hp,
            ucfirst($kritiksaran->jenis),
            $kritiksaran->pesan,
            $kritiksaran->tampilkan ? 'Ya' : 'Tidak',
            $kritiksaran->created_at ? $kritiksaran->created_at->format('d-m-Y H:i:s') : '-',
        ];
    }
}