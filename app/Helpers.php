<?php

namespace App;

use App\Models\Barangay;

class Helpers
{
    public static function get_barangays()
    {
        return Barangay::orderBy('name')->get();
    }

    public static function get_religions()
    {
        return [
            'Roman Catholic',
            'Islam',
            'Evangelicals (PCEC)',
            'Iglesia ni Cristo (INC)',
            'Non-Roman Catholic and Protestant (NCCP)',
            'Aglipayan',
            'Sevent-day Adventist (SDA)',
            'Bible Baptist Church',
            'United Church of Christ in the Philippines (UCCP)',
            "Jehovah's Witnesses",
            'None',
        ];
    }

    public static function get_civil_status()
    {
        return [
            'Single',
            'Married',
            'Divorced',
            'Widowed'
        ];
    }
    
}