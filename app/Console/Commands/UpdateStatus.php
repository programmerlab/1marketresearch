<?php

declare(strict_types=1);

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postTask:updateStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'postTask updateStatus when expired';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $d = date('Y-m-d');
        DB::table('post_tasks')
            ->where('dueDate', '<', date('Y-m-d'))
            ->where(DB::raw('STR_TO_DATE(dueDate,\'%Y-%m-%d\')'), '<', $d)
            ->where('status', 'open')
            ->update(['status' => 'expired']);

        $this->info('status updated successfully ' . date('m-d-Y'));
    }
}
