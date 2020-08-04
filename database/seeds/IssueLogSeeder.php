<?php

use App\IssueLog;
use Illuminate\Database\Seeder;

class IssueLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(IssueLog::class,38)->create();
    }
}
