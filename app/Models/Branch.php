<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    //    =======================Models Branch fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Area = One

    public function area(){

        return $this->belongsTo(Area::class);
    }

    //    =======================Relation  One To Many   Model = Employee = Many

    public function employees(){

        return $this->hasMany(Employee::class,'branch_id');
    }

    //    =======================Relation  One To Many   Model = Company = Many

    public function company(){

        return $this->hasMany(Company::class,'branch_id');
    }

    //    =======================Relation  One To Many   Model = Store = Many

    public function store(){

        return $this->hasMany(Store::class,'branche_id');
    }

    //    =======================Creat  Url  Photo


    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/branch/'.$this->photo);
    }
}
