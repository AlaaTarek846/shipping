<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    //    =======================Models Country fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Province = Many

    public function provinces(){

        return $this->hasMany(Province::class);
    }
    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }


}
