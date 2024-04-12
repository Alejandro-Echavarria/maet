<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $email = User::first()->email;

        $schedule->call(
            function () {
                $imageFiles = array_merge(
                    Storage::files('images/ckeditor/aboutme'),
                    Storage::files('images/ckeditor/jobs/body'),
                    Storage::files('images/ckeditor/jobs/preview')
                );

                $imagesDataBase = Image::pluck('url')->toArray();
                $delete = array_diff($imageFiles, $imagesDataBase);

                Storage::delete($delete);

                foreach ($delete as $image) {
                    Image::destroy($image->url);
                }
            }
        )
            ->timezone(config('app.timezone'))
            ->monthlyOn(1, '22:00')
            ->name("[Schedule] - Delete image CKEditor")
            ->emailOutputTo($email);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
