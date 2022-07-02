<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApiK extends Model
{
    use HasFactory;
    //    =======================Models UserApiK Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To One  Model=User=One

    public function user(){

        return $this->belongsTo(User::class);
    }
}
