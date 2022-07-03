<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    //    =======================Models Shipment Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Area = One

    public function area(){

        return $this->belongsTo(Area::class);
    }

    //    =======================Relation  One To Many   Model = Client = One

    public function client(){

        return $this->belongsTo(Client::class);
    }

    //    =======================Relation  One To Many   Model = Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  One To Many   Model = ServiceType = One

    public function serviceType(){

        return $this->belongsTo(ServiceType::class);
    }

    //    =======================Relation  One To Many   Model = ShipmentStatu = One

    public function shipmentstatu(){

        return $this->belongsTo(ShipmentStatu::class,'shipment_status_id');
    }
    //    =======================Relation  One To Many   Model = Reason = One

    public function reason(){

        return $this->belongsTo(Reason::class);
    }
    //    =======================Relation  AdditionalService

    public function additionalservice(){

        return $this->belongsTo(AdditionalService::class);
    }

    //    =======================Relation  One To Many   Model = Store = One

    public function store(){

        return $this->belongsTo(Store::class);
    }

    //    =======================Relation  One To Many   Model = ShipmentTransfer = Many

    public function shipmenttransfer(){

        return $this->hasMany(ShipmentTransfer::class);
    }
    //    =======================Relation  One To Many   Model = DetailShipmentRepresentative = Many

    public function detailShipmentRepresentative(){

        return $this->hasMany(DetailShipmentRepresentative::class);
    }
    //    =======================Relation  One To Many   Model = StockDetail = Many

    public function stock_detail(){

        return $this->hasMany(StockDetail::class);
    }
    //    =======================Relation  One To Many   Model = CompanyShipmentDetails = Many

    public function company_shipment_details(){

        return $this->hasMany(CompanyShipmentDetails::class);
    }
    //    =======================Relation  One To Many   Model = RepresentativeAccountDetail = Many

    public function representative_account_detail(){

        return $this->hasMany(RepresentativeAccountDetail::class);
    }
 //    =======================Relation  One To Many   Model = RepresentativeIncome = Many

    public function representativeIncome(){

        return $this->hasMany(RepresentativeIncome::class);
    }

    //    =======================Relation  One To Many   Model = User = One

    public function user(){

        return $this->belongsTo(User::class,'sender_id');

    }
    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }

    //    =======================Relation  One To Many   Model = Map = Many

    public function map(){

        return $this->hasMany(Map::class);
    }

    protected $appends = [
        'total_shipment'
    ];

    //============== appends paths ===========

    //append img path

    public function getTotalShipmentAttribute(): string
    {
        return $this->product_price + $this->shipping_price ;
    }



}
