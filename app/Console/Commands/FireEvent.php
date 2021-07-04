<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User; 
use App\Http\Controllers\Auth\LoginController;
use Session;
class FireEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fire';

    public function handle()
    {

        // $user = new LoginController();
        // $user->loginUsingId(3);
        Job::dispatch(['name' => 'admin' ,'email'=>'admin@admin.com' , 'password' => '$2y$10$SSN3qU6BriTKuxw490qSLOkErJeZvGXpApSHfiDBwVqFZ7CKmZAia']);
    }
}