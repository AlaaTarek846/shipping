<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    //    =======================Models PaymentType fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Company = Many

    public function company(){

        return $this->hasMany(Company::class);
    }


}
