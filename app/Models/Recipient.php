<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
    public function flaggedNames()
    {
        //Get all recipients
        $recipients = DB::table('recipients')->get();


        //Extract all with name strings with multiple capital letters in a row
        $multicaps = $recipients->filter(function ($recipient) {
            $multicap_regex = "/\w*[A-Z]\w*[A-Z]\w*/g";
           if (preg_match($multicap_regex, $recipient->first_name) || preg_match($multicap_regex, $recipient->last_name)) {
               return $recipient;
           }
        });


        //Extract all recipients with names that do not contain capital letters.
        $nocaps = $recipients->filter(function($recipient) {
           $cap_regex = "/[A-Z]/g";
            if (!(preg_match($cap_regex, $recipient->first_name)) || !(preg_match($cap_regex, $recipient->last_name))) {
                return $recipient;
            }
        });

        //Extract all with name strings with characters are are not letters, hyphens, spaces or apostrophes.

        $special_chars = $recipients->filter(function($recipient) {
            $no_special_char_regex = "/^[a-zA-Z'\s-]*$/g";
            if (!(preg_match($no_special_char_regex, $recipient->first_name)) || !(preg_match($no_special_char_regex, $recipient->last_name))) {
                return $recipient;
            }
        });

        $flagged_recipients = $multicaps->merge($nocaps);
        $flagged_recipients = $flagged_recipients->merge($special_chars);

        return $flagged_recipients;

    }

}
