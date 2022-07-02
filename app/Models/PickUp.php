<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUp extends Model
{
    use HasFactory;

    //    =======================Models PickUp fields

    protected $guarded = ['id'];

    //    =======================Relation One to Many  User

    public function user(){

        return $this->belongsTo(User::class);

    }

    //    =======================Relation One to Many  TransportType

    public function transporttype(){

        return $this->belongsTo(TransportType::class,'transport_type_id');

    }
}
