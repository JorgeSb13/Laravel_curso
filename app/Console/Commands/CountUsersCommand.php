<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CountUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:conunt-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command count the users registered';

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
        $users = User::all()->count();
        $this->info($users);
    }
}
