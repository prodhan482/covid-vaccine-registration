<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            ['name' => 'Gulshan Clinic', 'capacity' => 50],
            ['name' => 'Aalok Hospital', 'capacity' => 30],
            ['name' => 'Dhaka Medical College', 'capacity' => 20],
            ['name' => 'PG Hospital', 'capacity' => 25],
            ['name' => 'Islami Hospital', 'capacity' => 40],
            ['name' => 'Popular Hospital', 'capacity' => 35],
            ['name' => 'Enam Medical', 'capacity' => 15],
            ['name' => 'BIHS Hospital', 'capacity' => 60],
            ['name' => 'Mirpur Clinic', 'capacity' => 2],
            ['name' => 'Savar Clinic', 'capacity' => 30],
            ['name' => 'Narayanganj Health Center', 'capacity' => 25],
            ['name' => 'Chittagang Medical Center', 'capacity' => 45],
            ['name' => 'Suburban Clinic', 'capacity' => 20],
            ['name' => 'Emergency Vaccination Station', 'capacity' => 70],
            ['name' => 'Senior Health Center', 'capacity' => 15],
            ['name' => 'Youth Health Center', 'capacity' => 20],
            ['name' => 'Integrated Health Center', 'capacity' => 50],
            ['name' => 'Urban Community Clinic', 'capacity' => 30],
            ['name' => 'Vaccination Drive Center', 'capacity' => 100],
            ['name' => 'Health Outreach Clinic', 'capacity' => 25],
        ];

        foreach ($centers as $center) {
            VaccineCenter::create($center);
        }
    }
}
