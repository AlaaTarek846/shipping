<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory;

    //    =======================Models Treasury fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Treasury = Many

    public function children(){

        return $this->hasMany(Treasury::class,'treasury_id');
    }

    //    =======================Relation  One To Many   Model = IncomeAndExpense = Many

    public function income_and_expense(){

        return $this->hasMany(IncomeAndExpense::class,'treasurie_id');
    }

    //    =======================Relation  One To Many   Model = RepresentativeExpense = Many

    public function representative_expense(){

        return $this->hasMany(RepresentativeExpense::class,'treasurie_id');
    }

    //    =======================Relation  treasury

    public function treasury_start(){

        return $this->hasMany(TransferringTreasury::class,'treasurie_start_id');
    }

    public function treasury_end(){

        return $this->hasMany(TransferringTreasury::class,'treasurie_end_id');
    }

    protected $appends =[
        'income',
        'expense',
        'amount'
    ];

    public function getIncomeAttribute(){

       $income_and_expense = $this->income_and_expense()->whereNotNull('income_id')->sum('price');

       $treasury_end = $this->treasury_end()->sum('price');

       $total_income =  $treasury_end  + $income_and_expense  ;

       return $total_income;
    }

    public function getExpenseAttribute(){

        $income_and_expense = $this->income_and_expense()->whereNotNull('expense_id')->sum('price');

        $treasury_end = $this->treasury_start()->sum('price');

        $total_expense =  $treasury_end  + $income_and_expense  ;

        return $total_expense ;

    }

    public function getAmountAttribute(){
        return $this->income - $this->expense;
    }

}
