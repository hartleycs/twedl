<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/states.csv');
        if (! file_exists($path)) {
            $this->command->error("states.csv not found in database/seeders");
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $now   = now();

        foreach ($lines as $line) {
            $cols = str_getcsv($line);

            if (count($cols) < 5) {
                $this->command->warn("Skipping incomplete line: {$line}");
                continue;
            }

            [$country, /*unused*/ , $stateName, $lat, $lng] = $cols;
            $country   = trim($country);
            $stateName = trim($stateName);
            $latitude  = trim($lat) ?: null;
            $longitude = trim($lng) ?: null;

            // skip if country not seeded
            if (! DB::table('countries')->where('iso_code', $country)->exists()) {
                $this->command->warn("Skipping “{$stateName}”: country {$country} does not exist in countries table");
                continue;
            }

            try {
                DB::table('states')->updateOrInsert(
                    ['country_code' => $country, 'name' => $stateName],
                    [
                        'latitude'   => $latitude,
                        'longitude'  => $longitude,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
                $this->command->info("Upserted state “{$stateName}” for country {$country}");
            } catch (\Exception $e) {
                $this->command->error("Failed to upsert “{$stateName}”: " . $e->getMessage());
            }
        }

        $this->command->info("StateSeeder complete.");
    }
}
