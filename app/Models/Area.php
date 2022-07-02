<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    //    =======================Models Area fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = province = One

    public function province(){

        return $this->belongsTo(Province::class);
    }

    //    =======================Relation  One To Many   Model = branch = Many

    public function branch(){

        return $this->hasMany(Branch::class);
    }

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

    //    =======================Relation  One To Many   Model = ShippingAreaPrice = Many

    public function shipping_area_price(){

        return $this->hasMany(ShippingAreaPrice::class);
    }

    //    =======================Relation  One To Many   Model = CompanyShippingAreaPrice = Many

    public function company_shipping_area_prices(){

        return $this->hasMany(CompanyShippingAreaPrice::class,'area_id');
    }
    //    =======================Relation  One To Many   Model = RepresentativeArea = Many


    public function representative_area(){

        return $this->hasMany(RepresentativeArea::class,'area_id');
    }
    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }



}
