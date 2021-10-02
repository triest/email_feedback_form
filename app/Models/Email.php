<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable=['email','text','name','person_data_processing_agree'];

    protected $casts = [
            'person_data_processing_agree' => 'boolean',
    ];

    public function setPersonDataProcessingAgreeAttribute($value)
    {
        if($value=="true") {
            $this->attributes['person_data_processing_agree'] =1;
        }else{
            $this->attributes['person_data_processing_agree'] =0;

        }
    }
}
