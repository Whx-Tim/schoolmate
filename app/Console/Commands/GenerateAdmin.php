<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class GenerateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a admin user';

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
        $user = User::create(['username' => 'admin','password' => bcrypt('admin'), 'is_active' => 1, 'email' => '13418866733@163.com']);
        $user->info()->create(['adminset' => 5]);
        $this->info('create successful');
    }
}
