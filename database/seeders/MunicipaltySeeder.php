<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipio1 =  Province::where('name', 'Distrito Nacional')->first();
        $data = [
            'province_id' => $municipio1->id,
            'name' => 'Distrito Nacional',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }
        $municipio2 =  Province::where('name', 'Azua')->first();
        $data = [
            [
                'province_id' => $municipio2->id,
                'name' => 'Azua de Compostela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Estebanía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Guayabal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Las Charcas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Las Yayas de Viajama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Padre Las Casas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Peralta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Pueblo Viejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Sabana Yegua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio2->id,
                'name' => 'Tábara Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio3 =  Province::where('name', 'Baoruco')->first();
        $data = [
            [
                'province_id' => $municipio3->id,
                'name' => 'Neiba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio3->id,
                'name' => 'Galván',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio3->id,
                'name' => 'Los Ríos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio3->id,
                'name' => 'Villa Jaragua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio3->id,
                'name' => 'Tamayo',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio4 =  Province::where('name', 'Barahona')->first();
        $data = [
            [
                'province_id' => $municipio4->id,
                'name' => 'Barahona',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Cabral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'El Peñón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Enriquillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Fundación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Jaquimeyes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'La Ciénaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Las Salinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Paraíso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Polo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio4->id,
                'name' => 'Vicente Noble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio5 =  DB::table('provincias')->where('nombre', 'Dajabón')->first();
        $data = [
            [   
                'province_id' => $municipio5->id,
                'name' => 'Dajabón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio5->id,
                'name' => 'El Pino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio5->id,
                'name' => 'Loma de Cabrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio5->id,
                'name' => 'Partido',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio5->id,
                'name' => 'Restauración',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio6 =  DB::table('provincias')->where('nombre', 'Duarte')->first();
        $data = [
            [
                'province_id' => $municipio6->id,
                'name' => 'San Francisco de Macorís',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Arenoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Castillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Eugenio María de Hostos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Las Guáranas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Pimentel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio6->id,
                'name' => 'Villa Riva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio7 =  DB::table('provincias')->where('nombre', 'El Seibo')->first();
        $data = [
            [
                'province_id' => $municipio7->id,
                'name' => 'El Seibo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio7->id,
                'name' => 'Miches',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }


        $municipio8 = Province::where('name', 'Elías Piña')->first();
        $data = [
            [
                'province_id' => $municipio8->id,
                'name' => 'Comendador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio8->id,
                'name' => 'Bánica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio8->id,
                'name' => 'El Llano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio8->id,
                'name' => 'Hondo Valle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio8->id,
                'name' => 'Juan Santiago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio8->id,
                'name' => 'Pedro Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio9 =  Province::where('name', 'Espaillat')->first();
        $data = [
            [
                'province_id' => $municipio9->id,
                'name' => 'Moca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio9->id,
                'name' => 'Cayetano Germosén',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio9->id,
                'name' => 'Gaspar Hernández',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio9->id,
                'name' => 'Jamao al Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }
            

        $municipio10 =  Province::where('name', 'Hato Mayor')->first();
        $data = [
            [
                'province_id' => $municipio10->id,
                'name' => 'Hato Mayor del Rey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio10->id,
                'name' => 'El Valle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio10->id,
                'name' => 'Sabana de la Mar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio11 =  Province::where('name', 'Hermanas Mirabal')->first();
        $data = [
            [
                'province_id' => $municipio11->id,
                'name' => 'Salcedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio11->id,
                'name' => 'Tenares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio11->id,
                'name' => 'Villa Tapia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio12 =  Province::where('name', 'Independencia')->first();
        $data = [
            [
                'province_id' => $municipio12->id,
                'name' => 'Jimaní',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio12->id,
                'name' => 'Cristóbal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio12->id,
                'name' => 'Duvergé',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio12->id,
                'name' => 'La Descubierta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio12->id,
                'name' => 'Mella',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio12->id,
                'name' => 'Postrer Río',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio13 =  Province::where('name', 'La Altagracia')->first();
        $data = [
            [
                'province_id' => $municipio13->id,
                'name' => 'Higüey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio13->id,
                'name' => 'San Rafael del Yuma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio14 =  Province::where('name', 'La Romana')->first();
        $data = [
            [
                'province_id' => $municipio14->id,
                'name' => 'La Romana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio14->id,
                'name' => 'Guaymate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio14->id,
                'name' => 'Villa Hermosa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }


        $municipio15 =  Province::where('name', 'La Vega')->first();
        $data = [
            [
                'province_id' => $municipio15->id,
                'name' => 'La Concepción de La Vega',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio15->id,
                'name' => 'Constanza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio15->id,
                'name' => 'Jarabacoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio15->id,
                'name' => 'Jima Abajo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }
        

        $municipio16 =  Province::where('name', 'María Trinidad Sánchez')->first();
        $data = [
            [
                'province_id' => $municipio16->id,
                'name' => 'Nagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio16->id,
                'name' => 'Cabrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio16->id,
                'name' => 'El Factor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio16->id,
                'name' => 'Río San Juan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio17 =  Province::where('name', 'Monseñor Nouel')->first();
        $data = [
            [
                'province_id' => $municipio17->id,
                'name' => 'Bonao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio17->id,
                'name' => 'Maimón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio17->id,
                'name' => 'Piedra Blanca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio18 =  Province::where('name', 'Montecristi')->first();
        $data = [
            [
                'province_id' => $municipio18->id,
                'name' => 'Montecristi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio18->id,
                'name' => 'Castañuela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio18->id,
                'name' => 'Guayubín',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio18->id,
                'name' => 'Las Matas de Santa Cruz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio18->id,
                'name' => 'Pepillo Salcedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio18->id,
                'name' => 'Villa Vásquez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio19 =  Province::where('name', 'Monte Plata')->first();
        $data = [
            [
                'province_id' => $municipio19->id,
                'name' => 'Monte Plata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio19->id,
                'name' => 'Bayaguana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio19->id,
                'name' => 'Peralvillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio19->id,
                'name' => 'Sabana Grande de Boyá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio19->id,
                'name' => 'Yamasá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio20 =  Province::where('name', 'Pedernales')->first();
        $data = [
            [
                'province_id' => $municipio20->id,
                'name' => 'Pedernales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio20->id,
                'name' => 'Oviedo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio21 =  Province::where('name', 'Peravia')->first();
        $data = [
            [
                'province_id' => $municipio21->id,
                'name' => 'Peravia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio21->id,
                'name' => 'Nizao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio22 =  Province::where('name', 'Puerto Plata')->first();
        $data = [
            [
                'province_id' => $municipio22->id,
                'name' => 'Puerto Plata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Altamira',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Imbert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Los Hidalgos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Luperón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Sosúa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Villa Isabela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio22->id,
                'name' => 'Villa Montellano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio23 =  Province::where('name', 'Samaná')->first();
        $data = [
            [
                'province_id' => $municipio23->id,
                'name' => 'Samaná',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio23->id,
                'name' => 'Las Terrenas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio23->id,
                'name' => 'Sánchez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio24 =  Province::where('name', 'San Cristóbal')->first();
        $data = [
            [
                'province_id' => $municipio24->id,
                'name' => 'San Cristóbal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Bajos de Haina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Cambita Garabito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Los Cacaos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Sabana Grande de Palenque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'San Gregorio de Nigua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Villa Altagracia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio24->id,
                'name' => 'Yaguate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio25 =  Province::where('name', 'San José de Ocoa')->first();
        $data = [
            [
                'province_id' => $municipio25->id,
                'name' => 'San José de Ocoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio25->id,
                'name' => 'Rancho Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio25->id,
                'name' => 'Sabana Larga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio26 =  Province::where('name', 'San Juan')->first();
        $data = [
            [
                'province_id' => $municipio26->id,
                'name' => 'San Juan de la Maguana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio26->id,
                'name' => 'Bohechío',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio26->id,
                'name' => 'El Cercado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio26->id,
                'name' => 'Juan de Herrera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio26->id,
                'name' => 'Las Matas de Farfán',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio26->id,
                'name' => 'Vallejuelo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio27 =  Province::where('name', 'San Pedro de Macorís')->first();
        $data = [
            [
                'province_id' => $municipio27->id,
                'name' => 'San Pedro de Macorís',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio27->id,
                'name' => 'Consuelo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio27->id,
                'name' => 'Guayacanes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio27->id,
                'name' => 'Quisqueya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio27->id,
                'name' => 'Ramón Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio27->id,
                'name' => 'San José de Los Llanos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio28 =  Province::where('name', 'Sánchez Ramírez')->first();
        $data = [
            [
                'province_id' => $municipio28->id,
                'name' => 'Cotuí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio28->id,
                'name' => 'Cevicos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio28->id,
                'name' => 'Fantino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio28->id,
                'name' => 'La Mata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio29 =  Province::where('name', 'Santiago')->first();
        $data = [
            [
                'province_id' => $municipio29->id,
                'name' => 'Santiago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Bisonó',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Jánico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Licey al Medio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Puñal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Sabana Iglesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'San José de las Matas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Tamboril',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio29->id,
                'name' => 'Villa González',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }
        
        $municipio30 =  Province::where('name', 'Santiago Rodríguez')->first();
        $data = [
            [
                'province_id' => $municipio30->id,
                'name' => 'San Ignacio de Sabaneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio30->id,
                'name' => 'Los Almácigos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio30->id,
                'name' => 'Monción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio31 =  Province::where('name', 'Santo Domingo')->first();
        $data = [
            [
                'province_id' => $municipio31->id,
                'name' => 'Santo Domingo Este',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'Boca Chica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'Los Alcarrizos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'Pedro Brand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'San Antonio de Guerra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'Santo Domingo Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio31->id,
                'name' => 'Santo Domingo Oeste',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }

        $municipio32 =  Province::where('name', 'Valverde')->first();
        $data = [
            [
                'province_id' => $municipio32->id,
                'name' => 'Mao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio32->id,
                'name' => 'Esperanza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'province_id' => $municipio32->id,
                'name' => 'Laguna Salada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        foreach ($data as $municipality) {
            Municipality::create($municipality);
        }
    }
}
