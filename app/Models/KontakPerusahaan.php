<?php

namespace App\Models;

use App\Concerns\HasUlids;
use App\Models\Data\Kontak;
use App\Models\Data\Perusahaan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KontakPerusahaan extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'kontak_perusahaan';

    protected $fillable = [
        'kontak_id',
        'perusahaan_id',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' =>  'boolean',
    ];

    public function scopeActive(Builder $query)
    {
        $query->where('is_aktif', true);
    }

    public function kontak(): BelongsTo
    {
        return $this->belongsTo(Kontak::class);
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
