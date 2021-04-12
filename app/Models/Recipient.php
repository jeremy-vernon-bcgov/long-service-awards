<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
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
        return $this->belongsTo(Organization::class);
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
    public function flagNames()
    {
        //Get all recipients
        $recipients = DB::table('recipients')->get();

        //Extract all with name strings with multiple capital letters in a row
        $names


        //Extract all with name strings with no capital letters

        //Extract all with name strings with characters are are not letters, hyphens, spaces or apostrophes.
    }

}
