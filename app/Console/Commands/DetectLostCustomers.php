<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:detect-lost-customers')]
#[Description('Command description')]
class DetectLostCustomers extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
