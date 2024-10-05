<?php

namespace Database\Seeders;

use App\Models\KuotaProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KuotaProgram::create([
            'jenis_kegiatan' => 'Riset',
            'kuota' => 15
        ]);
        KuotaProgram::create([
            'jenis_kegiatan' => 'KKP',
            'kuota' => 15
        ]);
        KuotaProgram::create([
            'jenis_kegiatan' => 'Prakerin',
            'kuota' => 15
        ]);
    }
}
