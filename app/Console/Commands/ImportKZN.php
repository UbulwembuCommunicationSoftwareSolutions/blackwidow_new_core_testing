<?php

namespace App\Console\Commands;

use App\Models\Importer;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\DashHistory;

class importKZN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importKZN {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import KZN stats';

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
