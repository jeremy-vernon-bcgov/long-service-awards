<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public function options()
    {
        return $this->hasMany(AwardOption::class);
    }

    public function recipients()
    {
        return $this->hasManyThrough(Recipient::class, AwardSelection::class);
    }

}
