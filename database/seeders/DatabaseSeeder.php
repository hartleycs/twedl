<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Make sure countries exist before states
        $this->call([
            CountrySeeder::class,
            StateSeeder::class,
            PostcodeSeeder::class,
            // any other seeders you have…
        ]);
    }
}
\App\Models\User::where('email','hartley.corbin.stewart@gmail.com')
    ->update(['is_admin' => true]);
