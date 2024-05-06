<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class PurgeSoftDeletes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:softdeletes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge soft-deleted records older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $deletedTasks = Task::onlyTrashed()
            ->where('deleted_at', '<=', Carbon::now()->subDays(30))
            ->forceDelete();

        $this->info('Purged ' . $deletedTasks . ' soft-deleted records older than 30 days.');
  
    }
}
