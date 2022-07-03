<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    //    =======================Models Department fields

    protected $guarded = ['id'];
    //    =======================Relation  One To Many   Model = Employee = Many

    public function employees(){

        return $this->hasMany(Employee::class);
    }
    //    =======================Relation  One To Many   Model = admin = Many

    public function admin(){

        return $this->belongsTo(Admin::class);
    }
}
