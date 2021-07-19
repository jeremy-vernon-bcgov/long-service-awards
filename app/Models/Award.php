<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public function awardOptions()
    {
        return $this->hasMany(AwardOption::class, 'award_id', 'id');
    }

    public function recipients () {
        return $this->hasMany(Recipient::class);
    }
}
