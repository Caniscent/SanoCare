<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodGroupModel;

class FoodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodGroups = [];
    
        $data = [
            // group => [description, status]
            'biji bijian' => ['Makanan dari kelompok biji-bijian seperti kacang-kacangan.', true],
            'buah' => ['Berbagai jenis buah-buahan segar.', true],
            'bumbu' => ['Kelompok bumbu dapur seperti rempah-rempah.', true],
            'daging dan unggas' => ['Makanan yang berasal dari daging sapi, ayam, dan unggas lainnya.', true],
            'lemak minyak' => ['Minyak dan lemak yang digunakan dalam memasak.', true],
            'minuman' => ['Berbagai jenis minuman.', true],
            'produk gula' => ['Makanan dan minuman yang mengandung gula.', true],
            'produk laut' => ['Makanan dari hasil laut seperti ikan dan kerang.', true],
            'sayuran' => ['Berbagai macam sayuran segar.', true],
            'serealia' => ['Produk serealia seperti gandum dan beras.', true],
            'susu' => ['Produk susu dan olahannya.', true],
            'telur' => ['Berbagai jenis telur, seperti ayam dan bebek.', true],
            'umbi berpati' => ['Umbi-umbian seperti kentang dan ubi.', true],
        ];
    
        foreach ($data as $group => [$description, $status]) {
            $foodGroups[] = [
                'group' => $group,
                'description' => $description,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        FoodGroupModel::insert($foodGroups);
    }
}
