<?php

namespace App\Models\Data;

use App\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
    use HasUlids, SoftDeletes;

    protected $table = 'data_perusahaan';

    protected $fillable =
    [
        ''
    ];
}
