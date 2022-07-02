<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeAndExpense extends Model
{
    use HasFactory;

    //    =======================Models Income And Expense Fields

    protected $guarded = ['id'];

    //    =======================Relation  Treasury

    public function treasury(){

        return $this->belongsTo(Treasury::class,'treasurie_id');
    }
    //    =======================Relation  Income

    public function income(){

        return $this->belongsTo(Income::class);
    }
    //    =======================Relation  User

    public function user(){

        return $this->belongsTo(User::class);
    }
    //    =======================Relation  Expense

    public function expense(){

        return $this->belongsTo(Expense::class);
    }
}
