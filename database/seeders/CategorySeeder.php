<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomeTypes = [
            ['name' => 'Penjualan Produk', 'type' => 'income'],
            ['name' => 'Biaya Operasional', 'type' => 'expense']
        ];

        foreach ($incomeTypes as $type) {
            Category::create($type);
        }
    }
}
