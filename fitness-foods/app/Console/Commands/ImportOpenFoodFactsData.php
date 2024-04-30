<?php

namespace App\Console\Commands;

use App\Services\DataImporter;
use App\Services\FilesDataDownloader;
use Illuminate\Console\Command;

class ImportOpenFoodFactsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:openfoodfacts';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Import data from Open Food Facts';

    public function __construct(protected FilesDataDownloader $filesDataDownloader, protected DataImporter $dataImporter)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $files = $this->filesDataDownloader->getFiles();
            foreach ($files as $file) {
                $jsonData = $this->filesDataDownloader->getFileContent($file);
                $this->dataImporter->importData($jsonData);
            }

            $this->info('Data imported successfully');
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
        }
    }
}
