<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    //    =======================Models Income fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Income = Many

    public function children(){

        return $this->hasMany(Income::class,'income_id');
    }

    //    =======================Relation  One To Many   Model = IncomeAndExpense = Many

    public function incomeAndExpense(){

        return $this->hasMany(IncomeAndExpense::class);
    }



}
