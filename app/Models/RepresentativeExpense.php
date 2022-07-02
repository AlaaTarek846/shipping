<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeExpense extends Model
{
    use HasFactory;
    //    =======================Models Representative Expense  Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model= Treasury = One

    public function treasury(){

        return $this->belongsTo(Treasury::class);
    }


}
