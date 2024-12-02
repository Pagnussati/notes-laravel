<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user()
    {
        // Dizendo ao notes que ele pertence a UM usuario (belongsTo)
        return $this->belongsTo(User::class);
    }
}
