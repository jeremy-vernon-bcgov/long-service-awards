<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function recipient() {
        return $this->hasOne(Recipient::class);
    }
    public function vip() {
        return $this->hasOne(Vip::class);
    }
    public function community() {
        return $this->belongsTo(Community::class);
    }
}
