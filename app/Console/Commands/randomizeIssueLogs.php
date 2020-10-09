<?php

namespace App\Console\Commands;

use App\IssueLog;
use Illuminate\Console\Command;

class randomizeIssueLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'randomize:issuelog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Randomize Issue Logs';

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
        IssueLog::all()->each(function ($item) {
            $time = \Carbon\Carbon::now()->addDays(random_int(-30, 5));
            $item->created_at = $time;
            $item->returned_at = (random_int(0, 1)) ? $time->addDays(random_int(2, 27)) : null;
            $item->save();
        });
    }
}
