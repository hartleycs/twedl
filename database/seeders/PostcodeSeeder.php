<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostcodeSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/postcodes_simple.csv');

        if (! file_exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $now = now();
        $fh  = new \SplFileObject($path, 'r');
        $fh->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
        $fh->setCsvControl(';');

        foreach ($fh as $i => $row) {
            // each $row is an array of columns split on ';'
            if (! is_array($row) || count($row) < 2) {
                $this->command->warn("Line {$i}: skipping invalid row");
                continue;
            }

            [$stateCode, $postcode] = $row;
            $stateCode = trim($stateCode);
            $postcode  = trim($postcode);

            try {
                DB::table('postcodes')->updateOrInsert(
                    [ 'state_code' => $stateCode, 'postcode' => $postcode ],
                    [ 'updated_at' => $now, 'created_at' => $now ]
                );
                $this->command->info("Line {$i}: upserted {$postcode} for {$stateCode}");
            } catch (\Exception $e) {
                $this->command->error("Line {$i}: failed to upsert {$postcode} – {$e->getMessage()}");
            }
        }

        $this->command->info('Postcode seeding complete.');
    }
}
