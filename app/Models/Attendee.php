<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


     /**** RSVP form functions *****/

    /**
     * Get recipient record with additional fields.
     *  Get recipient and attendee status based on id from query string.
     * @param int $id: ID from the query string.
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getByRecipientId($id)
    {
        // TODO: We will need to add in Dietary and Accessibility.
        $result = DB::table('recipients')
            ->leftjoin('attendees', 'recipients.id', '=', 'attendees.recipient_id')
            ->leftjoin('ceremonies', 'recipients.ceremony_id', '=', 'ceremonies.id')
            ->select('recipients.first_name', 'recipients.last_name', 'attendees.*', 'ceremonies.*')
            ->where('recipients.id', '=', $id)
            ->first();
        return ($result);
    }

}
