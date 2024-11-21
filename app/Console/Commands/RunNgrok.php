<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunNgrok extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ngrok:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run ngrok tunnel for local development';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting ngrok...');

        // Change to match the ngrok binary path if necessary
        $ngrokCommand = 'ngrok http 80';

        // Start ngrok process
        shell_exec($ngrokCommand);

        $this->info('ngrok started successfully');
        return 0;
    }
}
