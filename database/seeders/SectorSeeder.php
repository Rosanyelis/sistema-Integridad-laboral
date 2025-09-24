<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipio1 =  Municipality::where('name', 'Azua de Compostela')->first();
        $data = [
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Barreras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Barro Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Clavellina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Emma Balaguer Viuda Vallejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Las Barías-La Estancia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Las Lomas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Los Jovillos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio1->id,
                'name' => 'Puerto Viejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $sector) {
            Sector::create($sector);
        }

        $municipio4 =  Municipality::where('name', 'Las Charcas')->first();
        $data = [
            [
                'municipality_id' => $municipio4->id,
                'name' => 'Hatillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio4->id,
                'name' => 'Palmar de Ocoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $sector) {
            Sector::create($sector);
        }

        
    }
}
