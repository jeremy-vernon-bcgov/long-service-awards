<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Recipient extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public function officeCommunity() {
        return $this->belongsTo(Community::class, 'office_address_community_id', 'id');
    }
    public function personalCommunity() {
        return $this->belongsTo(Community::class, 'personal_address_community_id');
    }
    public function supervisorCommunity() {
        return $this->belongsTo(Community::class, 'supervisor_address_community_id');
    }

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

    public function scopeGetFlaggedNames()
    {

    }

}
