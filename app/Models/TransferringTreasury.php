<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferringTreasury extends Model
{
    use HasFactory;

    //    =======================Models TransferringTreasury fields

    protected $guarded = ['id'];


    //    =======================Relation  User

    public function user(){

        return $this->belongsTo(User::class);
    }
    //    =======================Relation  treasury

    public function treasury_start(){

        return $this->belongsTo(Treasury::class,'treasurie_start_id');
    }

    public function treasury_end(){

        return $this->belongsTo(Treasury::class,'treasurie_end_id');
    }

}
