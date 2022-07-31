<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'offers_id', 'courses_id', 'photo', 'users_id', 'available'];

    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function courses():BelongsTo{
        return $this->belongsTo(Course::class);
    }

    public function appointments():HasMany
    {
        return $this->hasMany(Appointment::class);
    }



}
