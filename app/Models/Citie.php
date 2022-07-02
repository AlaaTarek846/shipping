<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citie extends Model
{
    use HasFactory;

    //    =======================Models Citie Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Governorate = One

    public function governorate(){

        return $this->belongsTo(Governorate::class);
    }

    //    =======================Relation   One To Many   Model = Client = Many

    public function client(){

        return $this->hasMany(Client::class,'city_id');
    }

    //    =======================Relation   One To Many   Model = Company = Many

    public function company(){

        return $this->hasMany(Company::class,'city_id');
    }

    //    =======================Relation   One To Many   Model = Employee = Many

    public function employee(){

        return $this->hasMany(Employee::class,'city_id');
    }

    //    =======================Relation   One To Many   Model = Representative = Many

    public function representative(){

        return $this->hasMany(Representative::class,'city_id');
    }
}
