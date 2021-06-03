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

    protected $guarded = [];

    /* protected $fillable = [
        'idir',
        'guid',
        'employee_number',
        'first_name',
        'last_name',
        'is_bcgeu_member',
        'award_id',
        'milestone',
        'milestone_year',
        'retiring_this_year',
        'retirement_date',
        'survey_participation',
        'government_email',
        'government_phone_number',
        'office_address_prefix',
        'office_address_suite',
        'office_address_street_address',
        'office_address_postal_code',
        'office_address_community_id',
        'organization_id',
        'branch_name',
        'personal_email',
        ''
        //TODO specify all mass-assignable fields.
        ];
    */
    public function officeCommunity() {
        return $this->belongsTo(Community::class, 'office_address_community_id');
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
    public function award()
    {
        return $this->belongsTo(Award::class, 'award_id');
    }
    public function ceremony() {
        return $this->belongsTo(Ceremony::class, 'ceremony_id');
    }

}
