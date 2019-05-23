<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProjectFreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fresh project with default admin';

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
     * @return mixed
     */
    public function handle()
    {
        //Migrate tables Fresh
        Artisan::call('migrate:fresh');
        $this->info('Migrating database fresh !');

        // Create admin
        Artisan::call('db:seed');
        $this->info('Creating admin with email admin@admin.com and password is password');

        Artisan::call('storage:link');

        $this->info('Project is fresh now, you can use it !');
    }
}
