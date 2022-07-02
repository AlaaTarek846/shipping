<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyShippingAreaPrice extends Model
{
    use HasFactory;
    //    =======================Models Company Shipping Area Price

    protected $guarded = ['id'];

    //    =======================Relation  Area

    public function area(){

        return $this->belongsTo(Area::class,'area_id');
    }
    //    =======================Relation  Company

    public function company(){

        return $this->belongsTo(Company::class,'company_id');
    }
}
