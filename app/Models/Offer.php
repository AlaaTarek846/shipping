<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    //    =======================Models Offer fields

    protected $guarded = ['id'];

    //    =======================Relation Many to Many  Storage System Company

    public function company(){

        return $this->belongsToMany(Company::class,'offer_companies','offer_id','company_id');

    }



}
