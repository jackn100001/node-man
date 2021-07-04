<?php

namespace App\Console\Commands;

use App\Jobs\CheckNodes;
use Illuminate\Console\Command;

class NodeUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nodes:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Keep node statuses updated';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            CheckNodes::dispatch();
            sleep(1);
        }
    }
}
