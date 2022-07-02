<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    use HasFactory;

    //    =======================Models  Package User  fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Package = One

    public function package(){

        return $this->belongsTo(Package::class);
    }
    //    =======================Relation  One To Many   Model = User = One

    public function user(){

        return $this->belongsTo(User::class,'sender_id');

    }
}
