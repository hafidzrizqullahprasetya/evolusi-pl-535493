<?php

namespace App\Services;

class IpCalculator
{
    // bobot UGM, referensi dari pedoman akademik
    public const BOBOT = [
        'A' => 4.0,
        'AB' => 3.5,
        'B' => 3.0,
        'BC' => 2.5,
        'C' => 2.0,
        'D' => 1.0,
        'E' => 0.0,
    ];

    // NIM UGM contoh: 24/535493/SV/24243
    public const POLA_NIM = '/^\d{2}\/\d{6}\/[A-Z]{2}\/\d{5}$/';

    public static function bobot(string $huruf): float
    {
        $key = strtoupper(trim($huruf));
        if (! isset(self::BOBOT[$key])) {
            throw new \InvalidArgumentException("Nilai huruf tidak dikenal: {$huruf}");
        }

        return self::BOBOT[$key];
    }

    public static function hitungIP(array $mataKuliah): float
    {
        if (empty($mataKuliah)) {
            throw new \InvalidArgumentException('Daftar mata kuliah tidak boleh kosong');
        }

        $totalSks = 0;
        $totalMutu = 0;

        foreach ($mataKuliah as $mk) {
            if (! isset($mk['sks']) || ! isset($mk['nilai'])) {
                throw new \InvalidArgumentException('Data mata kuliah tidak lengkap');
            }

            $sks = $mk['sks'];

            if (! is_numeric($sks) || floor((float) $sks) != (float) $sks || (float) $sks <= 0) {
                throw new \InvalidArgumentException("SKS harus bilangan bulat positif: {$sks}");
            }

            $sks = (int) $sks;
            $totalSks += $sks;
            $totalMutu += self::bobot($mk['nilai']) * $sks;
        }

        return round($totalMutu / $totalSks, 2);
    }

    public static function validasiNIM(string $nim): bool
    {
        return preg_match(self::POLA_NIM, strtoupper(trim($nim))) === 1;
    }
}
