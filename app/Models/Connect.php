<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;

    //    =======================Models Connect fields

    protected $guarded = ['id'];

    //    =======================Relation  User

    public function user(){

        return $this->belongsTo(User::class);

    }


}
