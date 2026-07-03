<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Contact::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);
        });
    }
}