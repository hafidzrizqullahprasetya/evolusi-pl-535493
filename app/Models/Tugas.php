<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = ['judul', 'mata_kuliah', 'tenggat', 'selesai'];

    protected function casts(): array
    {
        return [
            'tenggat' => 'date',
            'selesai' => 'boolean',
        ];
    }
}
