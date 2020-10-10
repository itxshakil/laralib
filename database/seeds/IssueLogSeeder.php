<?php

namespace Database\Seeders;

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
        IssueLog::factory()->count(60)->create();
    }
}
