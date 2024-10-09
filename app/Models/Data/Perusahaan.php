<?php

namespace App\Models\Data;

use App\Concerns\HasUlids;
use App\Models\KontakPerusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'data_perusahaan';

    protected $fillable =
    [
        'nama',
        'alamat',
    ];

    public function kontakPerusahaan(): HasMany
    {
        return $this->hasMany(KontakPerusahaan::class);
    }
}
