<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceremony extends Model
{
    use HasFactory;

    public function attendees ()
    {
        return $this->hasMany(Attendee::class);
    }
    public function recipients()
    {
        return $this->hasManyThrough(Recipient::class, Attendee::class);
    }
    public function vips()
    {
        return $this->hasManyThrough(Vip::class, Attendee::class);
    }
    public function guests()
    {
        return $this->hasManyThrough(Guest::class, Attendee::class);
    }

    public function organizationAttendees(int $organization_id)
    {

    }
    public function milestoneRecipients(int $milestone)
    {

    }
    //Return total count of attendees per dietary restriction
    public function dietaryRestrictionCounts() {

    }
    //Return total count of attendees per accessibility option
    public function accessibilityOptionCounts() {

    }


}
