<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    //    =======================Models Expense fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Expense = Many

    public function children(){

        return $this->hasMany(Expense::class,'expense_id');
    }

    //    =======================Relation  One To Many   Model = IncomeAndExpense = Many

    public function incomeAndExpense(){

        return $this->hasMany(IncomeAndExpense::class);
    }
}
