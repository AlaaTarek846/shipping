<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    //    =======================Models  Package Detail fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Package = One

    public function package(){

        return $this->belongsTo(Package::class);
    }


}
