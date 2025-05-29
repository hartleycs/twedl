<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $path  = database_path('seeders/Country_Codes.csv');
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $now   = Carbon::now();

        foreach ($lines as $line) {
            [$iso, $name] = str_getcsv($line);

            DB::table('countries')->updateOrInsert(
                ['iso_code' => $iso],
                [
                    // populate your NOT NULL ‘code’ column here:
                    'code'       => $iso,
                    'name'       => $name,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
