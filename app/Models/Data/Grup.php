<?php

namespace App\Models\Data;

use App\Concerns\HasUlids;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grup extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'data_grup';

    protected $fillable = [
        'nama',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_aktif', true);
    }
}
