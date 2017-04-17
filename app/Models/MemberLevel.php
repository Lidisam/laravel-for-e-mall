<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MemberLevel extends Model
{

    public function users()
    {
        return $this->hasMany(User::class, 'level_id');
    }
}
