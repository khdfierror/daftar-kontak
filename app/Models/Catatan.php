<?php

namespace App\Models;

use App\Concerns\HasUlids;
use App\Models\Data\Kontak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catatan extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'catatan';

    protected $fillable = [
        'kontak_id',
        'catatan',
    ];

    public function kontak(): BelongsTo
    {
        return $this->belongsTo(Kontak::class);
    }
}
