protected function schedule(Schedule $schedule)
{
    $schedule->command('events:generate-recurring')->daily();
}
