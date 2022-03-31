<?php

namespace App\Console;

use App\Models\PelayananJadwal;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        //tasking to change status PENDING TO
        $schedule->call(function () {
            PelayananJadwal::where('tanggal', '=', Carbon::yesterday()->format('Y-m-d'))
                ->where('refs->antrian', '!=', "")
                ->where('refs->status', '=', "pending")
                ->update(['refs->status' => "tidak_hadir"]);
        })->dailyAt('00:15');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
