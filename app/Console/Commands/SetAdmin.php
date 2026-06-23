<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:set-admin')]
#[Description('Command description')]
class SetAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = \App\Models\User::where('name', 'admin')->first();
        if ($user) {
            $user->role = 'admin';
            $user->save();
            $this->info('User admin set to role admin!');
        } else {
            $this->error('User admin not found.');
        }
    }
}
