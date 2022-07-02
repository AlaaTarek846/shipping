<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentStatu extends Model
{
    use HasFactory;

    //    =======================Models ShipmentStatu fields

    protected $guarded = ['id'];

    //    =======================Relation  Shipment

    public function shipment(){

        return $this->hasMany(Shipment::class,'shipment_status_id');
    }

    //    =======================Relation  company_shipment_details

    public function company_shipment_details(){

        return $this->hasMany(CompanyShipmentDetails::class);
    }
    //    =======================Relation  Representative Account Detail

    public function representative_account_detail(){

        return $this->hasMany(RepresentativeAccountDetail::class);
    }
    //    =======================Relation  DetailShipmentRepresentative  Detail

    public function detailShipmentRepresentative(){

        return $this->hasMany(DetailShipmentRepresentative::class);
    }

}
