<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    //    =======================Models  Package fields

    protected $guarded = ['id'];


    //    =======================Relation  One To Many   Model = PackageDetail = Many

    public function packageDetail(){

        return $this->hasMany(PackageDetail::class);
    }


    //    =======================Relation   One To Many   Model = User = Many

    public function user(){

        return $this->hasMany(User::class);
    }

    //    =======================Relation   One To Many   Model = User = Many

    public function packageUser(){

        return $this->hasMany(PackageUser::class);
    }


}
