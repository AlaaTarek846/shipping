<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeAccount extends Model
{
    use HasFactory;

    //    =======================Models Representative Account Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  One To Many   Model = RepresentativeAccountDetail = Many


    public function representative_account_detail(){

        return $this->hasMany(RepresentativeAccountDetail::class);
    }


}
