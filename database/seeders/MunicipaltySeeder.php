<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class MunicipaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $province1 =  Province::where('name', 'Distrito Nacional')->first();
        $data1 = [
            [
                'province_id' => $province1->id,
                'name' => 'Distrito Nacional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data1 as $municipality) {
            Municipality::create($municipality);
        }
        
        $province2 =  Province::where('name', 'Azua')->first();
        $data2 = [
            [
                'province_id' => $province2->id,
                'name' => 'Azua de Compostela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Estebanía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Guayabal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Las Charcas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Las Yayas de Viajama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Padre Las Casas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Peralta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Pueblo Viejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Sabana Yegua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province2->id,
                'name' => 'Tábara Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data2 as $municipality) {
            Municipality::create($municipality);
        }

        $province3 = Province::where('name', 'Baoruco')->first();
        $data3 = [
            [
                'province_id' => $province3->id,
                'name' => 'Neiba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province3->id,
                'name' => 'Galván',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province3->id,
                'name' => 'Los Ríos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province3->id,
                'name' => 'Tamayo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province3->id,
                'name' => 'Villa Jaragua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data3 as $municipality) {
            Municipality::create($municipality);
        }

        $province4 = Province::where('name', 'Barahona')->first();
        $data4 = [
            [
                'province_id' => $province4->id,
                'name' => 'Barahona',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Cabral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'El Peñón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Enriquillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Fundación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Jaquimeyes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'La Ciénaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Las Salinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Paraíso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Polo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province4->id,
                'name' => 'Vicente Noble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data4 as $municipality) {
            Municipality::create($municipality);
        }

        $province5 = Province::where('name', 'Dajabón')->first();
        $data5 = [
            [
                'province_id' => $province5->id,
                'name' => 'Dajabón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province5->id,
                'name' => 'El Pino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province5->id,
                'name' => 'Loma de Cabrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province5->id,
                'name' => 'Partido',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province5->id,
                'name' => 'Restauración',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data5 as $municipality) {
            Municipality::create($municipality);
        }

        $province6 = Province::where('name', 'Duarte')->first();
        $data6 = [
            [
                'province_id' => $province6->id,
                'name' => 'San Francisco de Macorís',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Arenoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Castillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Eugenio María de Hostos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Las Guáranas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Pimentel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province6->id,
                'name' => 'Villa Riva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data6 as $municipality) {
            Municipality::create($municipality);
        }

        $province7 = Province::where('name', 'El Seibo')->first();
        $data7 = [
            [
                'province_id' => $province7->id,
                'name' => 'El Seibo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province7->id,
                'name' => 'Miches',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($data7 as $municipality) {
            Municipality::create($municipality);
        }

        $province8 = Province::where('name', 'Elías Piña')->first();
        $data8 = [
            [
                'province_id' => $province8->id,
                'name' => 'Comendador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province8->id,
                'name' => 'Bánica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province8->id,
                'name' => 'El Llano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province8->id,
                'name' => 'Hondo Valle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province8->id,
                'name' => 'Juan Santiago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province8->id,
                'name' => 'Pedro Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data8 as $municipality) {
            Municipality::create($municipality);
        }

        $province9 = Province::where('name', 'Espaillat')->first();
        $data9 = [
            [
                'province_id' => $province9->id,
                'name' => 'Moca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province9->id,
                'name' => 'Cayetano Germosén',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province9->id,
                'name' => 'Gaspar Hernández',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province9->id,
                'name' => 'Jamao al Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data9 as $municipality) {
            Municipality::create($municipality);
        }

        $province10 = Province::where('name', 'Hato Mayor')->first();
        $data10 = [
            [
                'province_id' => $province10->id,
                'name' => 'Hato Mayor del Rey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province10->id,
                'name' => 'El Valle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province10->id,
                'name' => 'Sabana de la Mar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data10 as $municipality) {
            Municipality::create($municipality);
        }

        $province11 = Province::where('name', 'Hermanas Mirabal')->first();
        $data11 = [
            [
                'province_id' => $province11->id,
                'name' => 'Salcedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province11->id,
                'name' => 'Tenares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province11->id,
                'name' => 'Villa Tapia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data11 as $municipality) {
            Municipality::create($municipality);
        }

        $province12 = Province::where('name', 'Independencia')->first();
        $data12 = [
            [
                'province_id' => $province12->id,
                'name' => 'Jimaní',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province12->id,
                'name' => 'Cristóbal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province12->id,
                'name' => 'Duvergé',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province12->id,
                'name' => 'La Descubierta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province12->id,
                'name' => 'Mella',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province12->id,
                'name' => 'Postrer Río',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data12 as $municipality) {
            Municipality::create($municipality);
        }

        $province13 = Province::where('name', 'La Altagracia')->first();
        $data13 = [
            [
                'province_id' => $province13->id,
                'name' => 'Higüey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province13->id,
                'name' => 'San Rafael del Yuma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data13 as $municipality) {
            Municipality::create($municipality);
        }

        $province14 = Province::where('name', 'La Romana')->first();
        $data14 = [
            [
                'province_id' => $province14->id,
                'name' => 'La Romana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province14->id,
                'name' => 'Guaymate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province14->id,
                'name' => 'Villa Hermosa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data14 as $municipality) {
            Municipality::create($municipality);
        }

        $province15 = Province::where('name', 'La Vega')->first();
        $data15 = [
            [
                'province_id' => $province15->id,
                'name' => 'La Concepción de La Vega',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province15->id,
                'name' => 'Constanza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province15->id,
                'name' => 'Jarabacoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province15->id,
                'name' => 'Jima Abajo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data15 as $municipality) {
            Municipality::create($municipality);
        }

        $province16 = Province::where('name', 'María Trinidad Sánchez')->first();
        $data16 = [
            [
                'province_id' => $province16->id,
                'name' => 'Nagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province16->id,
                'name' => 'Cabrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province16->id,
                'name' => 'El Factor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province16->id,
                'name' => 'Río San Juan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data16 as $municipality) {
            Municipality::create($municipality);
        }

        $province17 = Province::where('name', 'Monseñor Nouel')->first();
        $data17 = [
            [
                'province_id' => $province17->id,
                'name' => 'Bonao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province17->id,
                'name' => 'Maimón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province17->id,
                'name' => 'Piedra Blanca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data17 as $municipality) {
            Municipality::create($municipality);
        }

        $province18 = Province::where('name', 'Montecristi')->first();
        $data18 = [
            [
                'province_id' => $province18->id,
                'name' => 'Montecristi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province18->id,
                'name' => 'Castañuela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province18->id,
                'name' => 'Guayubín',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province18->id,
                'name' => 'Las Matas de Santa Cruz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province18->id,
                'name' => 'Pepillo Salcedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province18->id,
                'name' => 'Villa Vásquez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data18 as $municipality) {
            Municipality::create($municipality);
        }

        $province19 = Province::where('name', 'Monte Plata')->first();
        $data19 = [
            [
                'province_id' => $province19->id,
                'name' => 'Monte Plata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province19->id,
                'name' => 'Bayaguana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province19->id,
                'name' => 'Peralvillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province19->id,
                'name' => 'Sabana Grande de Boyá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province19->id,
                'name' => 'Yamasá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data19 as $municipality) {
            Municipality::create($municipality);
        }

        $province20 = Province::where('name', 'Pedernales')->first();
        $data20 = [
            [
                'province_id' => $province20->id,
                'name' => 'Pedernales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province20->id,
                'name' => 'Oviedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data20 as $municipality) {
            Municipality::create($municipality);
        }

        $province21 = Province::where('name', 'Peravia')->first();
        $data21 = [
            [
                'province_id' => $province21->id,
                'name' => 'Baní',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province21->id,
                'name' => 'Nizao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data21 as $municipality) {
            Municipality::create($municipality);
        }

        $province22 = Province::where('name', 'Puerto Plata')->first();
        $data22 = [
            [
                'province_id' => $province22->id,
                'name' => 'Puerto Plata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Altamira',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Guananico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Imbert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Los Hidalgos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Luperón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Sosúa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Villa Isabela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province22->id,
                'name' => 'Villa Montellano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data22 as $municipality) {
            Municipality::create($municipality);
        }

        $province23 = Province::where('name', 'Samaná')->first();
        $data23 = [
            [
                'province_id' => $province23->id,
                'name' => 'Samaná',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province23->id,
                'name' => 'Las Terrenas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province23->id,
                'name' => 'Sánchez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data23 as $municipality) {
            Municipality::create($municipality);
        }

        $province24 = Province::where('name', 'San Cristóbal')->first();
        $data24 = [
            [
                'province_id' => $province24->id,
                'name' => 'San Cristóbal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Bajos de Haina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Cambita Garabito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Los Cacaos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Sabana Grande de Palenque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'San Gregorio de Nigua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Villa Altagracia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province24->id,
                'name' => 'Yaguate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data24 as $municipality) {
            Municipality::create($municipality);
        }

        $province25 = Province::where('name', 'San José de Ocoa')->first();
        $data25 = [
            [
                'province_id' => $province25->id,
                'name' => 'San José de Ocoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province25->id,
                'name' => 'Rancho Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province25->id,
                'name' => 'Sabana Larga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data25 as $municipality) {
            Municipality::create($municipality);
        }

        $province26 = Province::where('name', 'San Juan')->first();
        $data26 = [
            [
                'province_id' => $province26->id,
                'name' => 'San Juan de la Maguana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province26->id,
                'name' => 'Bohechío',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province26->id,
                'name' => 'El Cercado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province26->id,
                'name' => 'Juan de Herrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province26->id,
                'name' => 'Las Matas de Farfán',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province26->id,
                'name' => 'Vallejuelo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data26 as $municipality) {
            Municipality::create($municipality);
        }

        $province27 = Province::where('name', 'San Pedro de Macorís')->first();
        $data27 = [
            [
                'province_id' => $province27->id,
                'name' => 'San Pedro de Macorís',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province27->id,
                'name' => 'Consuelo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province27->id,
                'name' => 'Guayacanes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province27->id,
                'name' => 'Quisqueya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province27->id,
                'name' => 'Ramón Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province27->id,
                'name' => 'San José de Los Llanos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data27 as $municipality) {
            Municipality::create($municipality);
        }

        $province28 = Province::where('name', 'Sánchez Ramírez')->first();
        $data28 = [
            [
                'province_id' => $province28->id,
                'name' => 'Cotuí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province28->id,
                'name' => 'Cevicos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province28->id,
                'name' => 'Fantino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province28->id,
                'name' => 'La Mata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data28 as $municipality) {
            Municipality::create($municipality);
        }

        $province29 = Province::where('name', 'Santiago')->first();
        $data29 = [
            [
                'province_id' => $province29->id,
                'name' => 'Santiago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Bisonó',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Jánico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Licey al Medio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Puñal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Sabana Iglesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Tamboril',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'San José de las Matas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province29->id,
                'name' => 'Villa González',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data29 as $municipality) {
            Municipality::create($municipality);
        }

        $province30 = Province::where('name', 'Santiago Rodríguez')->first();
        $data30 = [
            [
                'province_id' => $province30->id,
                'name' => 'San Ignacio de Sabaneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province30->id,
                'name' => 'Los Almácigos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province30->id,
                'name' => 'Monción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data30 as $municipality) {
            Municipality::create($municipality);
        }

        $province31 = Province::where('name', 'Santo Domingo')->first();
        $data31 = [
            [
                'province_id' => $province31->id,
                'name' => 'Santo Domingo Este',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'Boca Chica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'Los Alcarrizos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'Pedro Brand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'San Antonio de Guerra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'Santo Domingo Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province31->id,
                'name' => 'Santo Domingo Oeste',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data31 as $municipality) {
            Municipality::create($municipality);
        }

        $province32 = Province::where('name', 'Valverde')->first();
        $data32 = [
            [
                'province_id' => $province32->id,
                'name' => 'Mao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province32->id,
                'name' => 'Esperanza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $province32->id,
                'name' => 'Laguna Salada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data32 as $municipality) {
            Municipality::create($municipality);
        }

    }
}
