<?php

namespace Tests\Feature;

use App\Models\Tugas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TugasApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_daftar_tugas_dikembalikan_sebagai_json(): void
    {
        Tugas::factory()->count(3)->create();

        $response = $this->getJson('/api/tugas');

        $response->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['id', 'judul', 'mata_kuliah', 'tenggat', 'selesai'],
                ],
            ]);
    }

    public function test_detail_tugas_dikembalikan_sebagai_json(): void
    {
        $tugas = Tugas::factory()->create(['judul' => 'Laporan P4']);

        $this->getJson("/api/tugas/{$tugas->id}")
            ->assertOk()
            ->assertJsonPath('data.judul', 'Laporan P4');
    }

    public function test_tugas_yang_tidak_ada_mengembalikan_404(): void
    {
        $this->getJson('/api/tugas/999999')->assertNotFound();
    }
}
