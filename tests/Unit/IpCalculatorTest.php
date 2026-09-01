<?php

namespace Tests\Unit;

use App\Services\IpCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IpCalculatorTest extends TestCase
{
    public function test_bobot_memetakan_nilai_huruf_ke_skala_4(): void
    {
        $this->assertEquals(4.0, IpCalculator::bobot('A'));
        $this->assertEquals(3.5, IpCalculator::bobot('ab'));
        $this->assertEquals(3.0, IpCalculator::bobot('B'));
        $this->assertEquals(2.5, IpCalculator::bobot('BC'));
        $this->assertEquals(2.0, IpCalculator::bobot('C'));
        $this->assertEquals(1.0, IpCalculator::bobot('D'));
        $this->assertEquals(0.0, IpCalculator::bobot('E'));
    }

    public function test_bobot_menolak_nilai_huruf_tidak_dikenal(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/tidak dikenal/');
        IpCalculator::bobot('Z');
    }

    public function test_hitungIP_menghitung_rata_rata_berbobot_sks(): void
    {
        $mk = [
            ['nama' => 'Evolusi & Konstruksi PL', 'sks' => 3, 'nilai' => 'A'],
            ['nama' => 'Basis Data', 'sks' => 3, 'nilai' => 'B'],
            ['nama' => 'Etika Profesi', 'sks' => 2, 'nilai' => 'AB'],
        ];
        // (4*3 + 3*3 + 3.5*2) / 8 = 28 / 8 = 3.5
        $this->assertEquals(3.5, IpCalculator::hitungIP($mk));
    }

    public function test_hitungIP_membulatkan_ke_dua_angka_di_belakang_koma(): void
    {
        $mk = [
            ['nama' => 'A', 'sks' => 3, 'nilai' => 'A'],
            ['nama' => 'B', 'sks' => 2, 'nilai' => 'BC'],
        ];
        // (12 + 5) / 5 = 3.4
        $this->assertEquals(3.4, IpCalculator::hitungIP($mk));
    }

    public function test_hitungIP_menolak_daftar_kosong(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/tidak boleh kosong/');
        IpCalculator::hitungIP([]);
    }

    public function test_hitungIP_menolak_sks_bukan_bilangan_bulat_positif(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IpCalculator::hitungIP([['sks' => 0, 'nilai' => 'A']]);
    }

    public function test_hitungIP_menolak_sks_negatif(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IpCalculator::hitungIP([['sks' => -2, 'nilai' => 'A']]);
    }

    public function test_hitungIP_menolak_sks_float(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IpCalculator::hitungIP([['sks' => 2.5, 'nilai' => 'A']]);
    }
}
