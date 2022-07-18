<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeArea extends Model
{
    use HasFactory;
    //    =======================Models Representative Area Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model= Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  One To Many   Model= Area = One

    public function area(){

        return $this->belongsTo(Area::class);
    }

    //    =======================Relation  One To Many   Model= ServiceType = One

    public function service_type(){

        return $this->belongsTo(ServiceType::class);
    }

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }
}
