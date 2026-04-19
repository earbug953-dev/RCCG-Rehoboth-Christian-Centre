<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rccgrehoboth.org'],
            [
                'name'     => 'RCCG Admin',
                'email'    => 'admin@rccgrehoboth.org',
                'password' => Hash::make('Admin@1234'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('✅ Admin user created: admin@rccgrehoboth.org / Admin@1234');
        $this->command->warn('⚠️  Please change the default password immediately!');
    }
}
