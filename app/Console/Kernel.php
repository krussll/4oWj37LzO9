<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\PullHashtags',
		'App\Console\Commands\PriceHashtags',
		'App\Console\Commands\HashtagClearup',
		'App\Console\Commands\UpdateHashtags',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('hashtag:pull')
		 				 ->everyTenMinutes();

	 	$schedule->command('hashtag:price')
	 				 ->everyThirtyMinutes();

		 $schedule->command('hashtag:clearup')
		 				->daily();
	}

}
