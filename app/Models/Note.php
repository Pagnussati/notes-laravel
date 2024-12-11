<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    public function user()
    {
        // Dizendo ao notes que ele pertence a UM usuario (belongsTo)
        return $this->belongsTo(User::class);
    }
}
