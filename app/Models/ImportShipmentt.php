<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportShipmentt extends Model
{
    use HasFactory;

    //    =======================Models ImportShipmentt Fields

    protected $guarded = ['id'];

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }


}
