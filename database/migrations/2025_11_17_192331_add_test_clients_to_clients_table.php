<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $clients = [
            [
                'name' => 'Иван',
                'lastName' => 'Иванов',
                'phone' => '+7 (911) 123-45-67',
                'passportData' => '4510 123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Петр',
                'lastName' => 'Петров',
                'phone' => '+7 (912) 234-56-78',
                'passportData' => '4510 234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Анна',
                'lastName' => 'Кузнецова',
                'phone' => '+7 (914) 456-78-90',
                'passportData' => '4510 456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Сергей',
                'lastName' => 'Смирнов',
                'phone' => '+7 (915) 567-89-01',
                'passportData' => '4510 567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ольга',
                'lastName' => 'Попова',
                'phone' => '+7 (916) 678-90-12',
                'passportData' => '4510 678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Дмитрий',
                'lastName' => 'Васильев',
                'phone' => '+7 (917) 789-01-23',
                'passportData' => '4510 789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Елена',
                'lastName' => 'Новикова',
                'phone' => '+7 (918) 890-12-34',
                'passportData' => '4510 890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Алексей',
                'lastName' => 'Федоров',
                'phone' => '+7 (919) 901-23-45',
                'passportData' => '4510 901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Наталья',
                'lastName' => 'Морозова',
                'phone' => '+7 (920) 012-34-56',
                'passportData' => '4510 012345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Максим',
                'lastName' => 'Созыкин',
                'phone' => '+7 (919) 303-23-45',
                'passportData' => '4510 923854',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Анастасия',
                'lastName' => 'Дроботова',
                'phone' => '+7 (919) 251-34-45',
                'passportData' => '4670 253714',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('clients')->insert($clients);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $passportNumbers = [
            '4510 123456',
            '4510 234567',
            '4510 345678',
            '4510 456789',
            '4510 567890',
            '4510 678901',
            '4510 789012',
            '4510 890123',
            '4510 901234',
            '4510 012345',
            '4510 923854',
            '4670 253714'
        ];

        DB::table('clients')->whereIn('passportData', $passportNumbers)->delete();
    }
};
