<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RestoreDatabase extends Command
{
    protected $signature = 'db:restore {path}';
    protected $description = 'Restore the database from a backup file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $path = $this->argument('path');

        if (!file_exists($path)) {
            $this->error("The file at {$path} does not exist.");
            return;
        }

        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $command = sprintf('mysql -u %s -p\'%s\' %s < %s', $dbUser, $dbPass, $dbName, $path);

        $process = Process::fromShellCommandline($command);
        try {
            $process->mustRun();
            $this->info('Database restoration was successful.');
        } catch (ProcessFailedException $exception) {
            $this->error('Database restoration failed.');
        }
    }
}
