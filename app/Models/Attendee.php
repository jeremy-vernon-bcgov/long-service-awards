<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    public function type () {

    }
    public function recipient() {
        return $this->belongsTo(Recipient::class);
    }
    public function vip() {
        return $this->belongsTo(Vip::class);
    }
    public function guest() {
        return $this->belongsTo(Guest::class, );
    }
    public function ceremonies() {
        return $this->belongsTo(Ceremony::class);
    }
    public function dietaryRestrictions() {
        return $this->hasMany(DietaryRestriction::class);
    }
    public function accessibilityOptions() {
        return $this->hasMany(AccessibilityOption::class);
    }


}
