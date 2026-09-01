<?php

namespace App\Services;

class IpCalculator
{
    // Bobot nilai huruf pada skala 4.00 (pedoman akademik UGM)
    public const BOBOT = [
        'A' => 4.0,
        'AB' => 3.5,
        'B' => 3.0,
        'BC' => 2.5,
        'C' => 2.0,
        'D' => 1.0,
        'E' => 0.0,
    ];

    // Format NIM UGM: 21/475123/PA/20512  ->  2 digit / 6 digit / 2 huruf / 5 digit
    public const POLA_NIM = '/^\d{2}\/\d{6}\/[A-Z]{2}\/\d{5}$/';

    public static function bobot(string $huruf): float
    {
        $key = strtoupper(trim($huruf));
        if (! array_key_exists($key, self::BOBOT)) {
            throw new \InvalidArgumentException("Nilai huruf tidak dikenal: {$huruf}");
        }

        return self::BOBOT[$key];
    }

    /**
     * @param  array<int, array{sks: mixed, nilai: string}>  $mataKuliah
     */
    public static function hitungIP(array $mataKuliah): float
    {
        if (count($mataKuliah) === 0) {
            throw new \InvalidArgumentException('Daftar mata kuliah tidak boleh kosong');
        }

        $totalSks = 0;
        $totalMutu = 0.0;

        foreach ($mataKuliah as $mk) {
            if (! isset($mk['sks']) || ! isset($mk['nilai'])) {
                throw new \InvalidArgumentException('Data mata kuliah tidak lengkap');
            }

            $sksRaw = $mk['sks'];

            if (! is_numeric($sksRaw)) {
                throw new \InvalidArgumentException("SKS harus bilangan bulat positif: {$sksRaw}");
            }

            $sksFloat = (float) $sksRaw;

            if (floor($sksFloat) != $sksFloat || $sksFloat <= 0) {
                throw new \InvalidArgumentException("SKS harus bilangan bulat positif: {$sksRaw}");
            }

            $sks = (int) $sksFloat;
            $totalSks += $sks;
            $totalMutu += self::bobot((string) $mk['nilai']) * $sks;
        }

        return round($totalMutu / $totalSks, 2);
    }

    public static function validasiNIM(string $nim): bool
    {
        return (bool) preg_match(self::POLA_NIM, strtoupper(trim($nim)));
    }
}
