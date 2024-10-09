<?php

namespace App\Models;

use App\Concerns\HasUlids;
use App\Models\Data\Kontak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tugas extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'tugas';

    protected $fillable = [
        'kontak_id',
        'judul',
        'deskripsi',
        'tenggat',
    ];

    protected $casts = [
        'tenggat' => 'date',
    ];

    public function kontak(): BelongsTo
    {
        return $this->belongsTo(Kontak::class);
    }
}
