<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyShipmentDetails extends Model
{
    use HasFactory;
    //    =======================Models Company Shipment Details

    protected $guarded = ['id'];

    //    =======================Relation  Company

    public function company(){

        return $this->belongsTo(Company::class,'company_id');
    }
    //    =======================Relation  Shipment

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }
    //    =======================Relation  CompanyAccount

    public function company_account(){

        return $this->belongsTo(CompanyAccount::class);
    }

    //    =======================Relation  ShipmentStatu

    public function shipmentstatu(){

        return $this->belongsTo(ShipmentStatu::class,'shipment_status_id');
    }

}
