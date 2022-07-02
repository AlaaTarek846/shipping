<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    //    =======================Models Governorate Fields

    protected $guarded = ['id'];

    //    =======================Relation One To Many   Model=Citie=Many

    public function citie(){

        return $this->hasMany(Citie::class);
    }
}
