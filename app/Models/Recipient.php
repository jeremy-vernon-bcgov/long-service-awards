<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    public function accessibilityOptions ()
    {
        return $this->hasManyThrough(AccessbilityOption::class, Attendee::class);
    }
    public function dietaryRestrictions()
    {
        return $this->hasManyThrough(DietaryRestriction::class, Attendee::class);
    }
    public function organization()
    {
        return $this->hasOne(Organization::class);
    }
    public function guest()
    {
        return $this->hasOne(Guest::class);
    }
    public function personalAddress()
    {
        return $this->belongsTo(Address::class, 'personal_address_id');
    }
    public function governmentAddress()
    {
        return $this->belongsTo(Address::class, 'government_address_id');
    }
    public function supervisorAddress()
    {
        return $this->belongsTo(Address::class, 'supervisor_address_id');
    }

}
