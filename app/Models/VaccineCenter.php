<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
    ];

    // Define relationship with VaccinationSchedule
    public function vaccinationSchedules()
    {
        return $this->hasMany(VaccinationSchedule::class);
    }
}
