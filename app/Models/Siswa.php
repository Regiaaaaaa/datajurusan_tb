<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'name',
        'jurusan_id',
        'eskul_id'

    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function eskul(): BelongsTo
    {
        return $this->belongsTo(Eskul::class);
    }
}
