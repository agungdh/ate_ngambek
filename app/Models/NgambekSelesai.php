<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NgambekSelesai extends Model
{
    /** @use HasFactory<\Database\Factories\NgambekSelesaiFactory> */
    use HasFactory;

    public function ngambek():BelongsTo {
        return $this->belongsTo(Ngambek::class);
    }
}
