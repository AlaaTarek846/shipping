<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    //    =======================Models Stock Fields

    protected $guarded = ['id'];

    //    =======================Relation  Store

    public function store(){

        return $this->belongsTo(Store::class);
    }

    //    =======================Relation  Company

    public function company(){

        return $this->belongsTo(Company::class);
    }


    //    =======================Relation  Stock Detail

    public function stock_detail(){

        return $this->hasMany(StockDetail::class);
    }

}
