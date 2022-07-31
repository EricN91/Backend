<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=['appointments_id','date_time', 'accepted', 'offers_id', 'students_id', 'tutors_id' ];

    public function students():BelongsTo{
        return $this->belongsTo(User::class,'students_id','id');
    }

    public function tutors():BelongsTo{
        return $this->belongsTo(User::class,'tutors_id','id');
    }

    public function offers():BelongsTo{
        return $this->belongsTo(Offer::class);
    }


}
