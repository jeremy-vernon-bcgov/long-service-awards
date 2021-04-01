<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardOption extends Model
{
    use HasFactory;

    public function award ()
    {
        return $this->belongsTo(Award::class);
    }

    public function selections()
    {
        return $this->hasMany(AwardOption::class);
    }
}
