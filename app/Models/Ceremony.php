<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceremony extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
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



}
