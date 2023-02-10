<?php

namespace App\Console\Commands;

use App\Models\Importer;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\DashHistory;

class importOldConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importOldConsole {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import old console data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            Importer::Import($this->argument('url'));
    }
}
