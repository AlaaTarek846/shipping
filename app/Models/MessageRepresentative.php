<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRepresentative extends Model
{
    use HasFactory;

    //    =======================Models Message Representative Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model= Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/message_representative/'.$this->photo);
    }
}
