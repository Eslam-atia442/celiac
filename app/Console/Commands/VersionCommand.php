<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this Command To get the latest version of application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Version: ". config('app.version'));
    }
}
