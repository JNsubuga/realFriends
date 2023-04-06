<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactiontypes = ['Pay', 'Receive'];
        foreach ($transactiontypes as $transactiontype) {
            Event::create(['Event' => $transactiontype]);
        }
    }
}
