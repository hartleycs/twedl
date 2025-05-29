<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRecurringEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-recurring-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = now()->addMonth();
        Event::whereNotNull('recurrence_rule')
             ->where('status','V')
             ->cursor()
             ->each(function($event) use ($cutoff) {
                 $dates = $event->getOccurrencesBetween(now(), $cutoff);
                 // e.g. delete old, then insert new EventOccurrence records
                 foreach ($dates as $dt) {
                     EventOccurrence::firstOrCreate([
                         'event_id' => $event->id,
                         'occurrence_datetime' => $dt,
                     ]);
                 }
             });
        $this->info('Recurring events generated.');
        
    }
}
