<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardSelection extends Model
{
    use HasFactory;

    public function award_option ()
    {
        return $this->belongsTo(AwardOption::class);
    }
    public function award ()
    {
        return $this->hasOneThrough(Award::class, AwardOption::class);
    }
    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
