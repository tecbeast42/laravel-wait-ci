<?php

namespace Tecbeast42\LaravelWaitCi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaravelWaitCiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ci:wait
                            {timeout=60 : How many tries to reach the DBs and disks}
                            {--db-connections= : Comma Separated list of DB connections}
                            {--storage-disks= : Comma Separated list of storage disks}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Block cli until databases and storage disks are available';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $tries = $this->argument('timeout');
        $dbs = explode(',', $this->option('db-connections'));
        $disks = explode(',', $this->option('storage-disks'));
        $databaseReached = array_fill(0, count($dbs), false);
        $storageReached = array_fill(0, count($disks), false);

        while (--$tries >= 0) {
            foreach ($dbs as $key => $db) {
                if (! $databaseReached[$key]) {
                    try {
                        $t = DB::connection($db)->getDatabaseName();
                        $this->info('Database '.$t.' is reachable');
                        $databaseReached[$key] = true;
                    } catch (\Throwable $t) {
                        sleep(1);
                        $this->warn('Database '.$db.' not reachable. Remaing tries: '.$tries);
                    }
                }
            }
            foreach ($disks as $key => $disk) {
                if (! $storageReached[$key]) {
                    try {
                        if ($disk === '') {
                            Storage::listContents('/');
                        } else {
                            Storage::disk($disk)->listContents('/');
                        }
                        $this->info('Storage '.$disk.' is reachable');
                        $storageReached[$key] = true;
                    } catch (\Throwable $t) {
                        sleep(1);
                        $this->warn('Storage '.$disk.' not reachable. Remaing tries: '.$tries);
                    }
                }
            }

            if (!in_array(false, $storageReached, true) && !in_array(false, $databaseReached, true)) {
                return 0;
            }
        }

        return 1;
    }
}
