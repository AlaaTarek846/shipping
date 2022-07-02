<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeMove extends Model
{
    use HasFactory;
    //    =======================Models Representative Move Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model= Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }
}
