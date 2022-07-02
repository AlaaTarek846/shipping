<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    //    =======================Models Province fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Country = One

    public function country(){

        return $this->belongsTo(Country::class);
    }

    //    =======================Relation  One To Many   Model = Area = Many

    public function areas(){

        return $this->hasMany(Area::class);
    }
    //    =======================Relation  One To Many   Model = ShippingAreaPrice = Many

    public function shippingAreaPrice(){

        return $this->hasMany(ShippingAreaPrice::class);
    }

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }

}
