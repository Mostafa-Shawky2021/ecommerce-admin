<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class NewAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'make:admin {email} {password}';
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin in database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        if (env('APP_ENV') == 'production') {
            $email = 'admin@admin.com';
            $userExist =  User::firstWhere('email', $email);
            if ($userExist) return false;
            User::create([
                'name' => 'admin',
                'email' => $email,
                'password' => Hash::make('admin'),
                'is_admin' => 1,
            ]);
            return true;
        }
        //  development mode
        $name = $this->ask('Enter user name');
        $email = $this->ask('Enter email Address');
        $password = $this->ask('Enter user password');

        $validator = Validator::make(['email' => $email], [
            'email' => 'email|unique:users',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first('email'));
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => 1,
        ]);

        return $this->info('admin created successfully');
    }
}
