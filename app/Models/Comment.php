<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comments_id', 'offers_id', 'textarea', 'date_time', 'students_id', 'tutors_id'];

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
