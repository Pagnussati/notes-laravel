<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function notes()
    {
        // Dizendo ao model do usuario que pode haver muitas notes (hasMany)
        return $this->hasMany(Note::class);
    }
}
