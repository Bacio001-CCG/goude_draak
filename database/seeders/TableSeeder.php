<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Table::factory()->create(['name' => 'Table 1']);
        Table::factory()->create(['name' => 'Table 2']);
        Table::factory()->create(['name' => 'Table 3']);
        Table::factory()->create(['name' => 'Table 4']);
        Table::factory()->create(['name' => 'Table 5']);
        Table::factory()->create(['name' => 'Table 6']);
        Table::factory()->create(['name' => 'Table 7']);
        Table::factory()->create(['name' => 'Table 8']);
        Table::factory()->create(['name' => 'Table 9']);
        Table::factory()->create(['name' => 'Table 10']);
    }
}
