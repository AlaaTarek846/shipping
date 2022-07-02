<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    //    =======================Models Company Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To One  Model = User = One

    public function user(){

        return $this->belongsTo(User::class);
    }

    //    =======================Relation  One To Many   Model = Citie = One

    public function citie(){

        return $this->belongsTo(Citie::class,'city_id');
    }

   //    =======================Relation  One To Many  Model = CompanyShippingAreaPrice = One

    public function company_shipping_area_prices(){

        return $this->hasMany(CompanyShippingAreaPrice::class,'company_id');
    }

    //    =======================Relation  One To Many   Model = company_account = Many

    public function company_account(){

        return $this->hasMany(CompanyAccount::class,'company_id');
    }
    //    =======================Relation  One To Many   Model = company_shipment_details = Many

    public function company_shipment_details(){

        return $this->hasMany(CompanyShipmentDetails::class,'company_id');
    }

    //    =======================Relation  One To Many   Model = WeightCompany = Many

    public function weight_company(){

        return $this->hasMany(WeightCompany::class,'company_id');
    }

    //    =======================Relation  One To Many   Model = Branch = One

    public function branch(){

        return $this->belongsTo(Branch::class);
    }

    //    =======================Relation  One To Many   Model = PaymentType = One

    public function payment_type(){

        return $this->belongsTo(PaymentType::class);
    }
    //    =======================Relation  Many To Many   Model = storage_system_companies & StorageSystem = Many

    public function storage_system(){

        return $this->belongsToMany(StorageSystem::class,'storage_system_companies','company_id','storage_system_id');

    }

    //    =======================Relation  Many To Many   Model = offer_companies & Offer = Many

    public function offer(){

        return $this->belongsToMany(Offer::class,'offer_companies','company_id','offer_id');

    }
    //    =======================Relation  One To Many   Model = stock = Many

    public function stock(){

        return $this->hasMany(Stock::class);
    }

    //    =======================Creat  Url  Photo

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/company/'.$this->photo);
    }
}
