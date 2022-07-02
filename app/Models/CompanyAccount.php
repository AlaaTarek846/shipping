<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    use HasFactory;
    //    =======================Models Company Account

    protected $guarded = ['id'];

    //    =======================Relation  Company

    public function company(){

        return $this->belongsTo(Company::class,'company_id');
    }

    //    =======================Relation  company_shipment_details

    public function company_shipment_details(){

        return $this->hasMany(CompanyShipmentDetails::class);
    }

}
