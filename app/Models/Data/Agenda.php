<?php

namespace App\Models\Data;

use App\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'data_agenda';

    protected $fillable = [
        'kontak_id',
        'nama',
        'tanggal',
        'waktu',
        'lokasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'date',
    ];

    public function kontak(): BelongsTo
    {
        return $this->belongsTo(Kontak::class);
    }
}
