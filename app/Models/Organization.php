<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Organization extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    public function vips () {
        return $this->hasMany(Vip::class);
    }
    public function recipients () {
        return $this->hasMany(Recipient::class);
    }

    public function cohort_count(int $milestone, array $regions) {

    }

    public function getCohorts( ) {

    }
    public function setCohortToCeremonyNumber(int $milestone, string $region, int $ceremonyNumber) {

    }
}
