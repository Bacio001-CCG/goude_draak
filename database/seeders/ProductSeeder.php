<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soupCategory = Category::factory()->create(['name' => 'Soup']);
        $voorgerechtCategory = Category::factory()->create(['name' => 'Voorgerecht']);
        $bamiEnNasiGerechtenCategory = Category::factory()->create(['name' => 'Bami en Nasi Gerechten']);
        $combinatieGerechtenCategory = Category::factory()->create(['name' => 'Combinatie Gerechten (met witte rijst)']);
        $mihoenGerechtenCategory = Category::factory()->create(['name' => 'Mihoen Gerechten']);
        $chineseBamiGerechtenCategory = Category::factory()->create(['name' => 'Chinese Bami Gerechten']);
        $indischeGerechtenCategory = Category::factory()->create(['name' => 'Indische Gerechten']);
        $eierGerechtenCategory = Category::factory()->create(['name' => 'Eiergerechten (met witte rijst)']);
        $groentenGerechtenCategory = Category::factory()->create(['name' => 'Groenten Gerechten (met witte rijst)']);
        $vleesGerechtenCategory = Category::factory()->create(['name' => 'Vlees Gerechten (met witte rijst)']);
        $kipGerechtenCategory = Category::factory()->create(['name' => 'Kipgerechten (met witte rijst)']);
        $garnalenGerechtenCategory = Category::factory()->create(['name' => 'Garnalen Gerechten (met witte rijst)']);

        $ossenhaasGerechtenCategory = Category::factory()->create(['name' => 'Ossenhaas Gerechten (met witte rijst)', 'is_pickup' => true]);
        $pekingEendGerechtenCategory = Category::factory()->create(['name' => 'Pekking Eend Gerechten (met witte rijst)', 'is_pickup' => true]);
        $tiepanSpecialiteitenCategory = Category::factory()->create(['name' => 'Tiepan Specialiteiten (met witte rijst)', 'is_pickup' => true]);
        $vegetarischeGerechtenCategory = Category::factory()->create(['name' => 'Vegetarische Gerechten (met witte rijst)', 'is_pickup' => true]);
        $rijsttafelsCategory = Category::factory()->create(['name' => 'Rijsttafels', 'is_pickup' => true]);
    }
}
