<?php

namespace App\Models\Data;

use App\Concerns\HasUlids;
use App\Models\Catatan;
use App\Models\Tugas;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'data_kontak';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'email',
        'phone',
        'alamat',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_aktif', true);
    }

    public function catatan(): HasMany
    {
        return $this->hasMany(Catatan::class);
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
