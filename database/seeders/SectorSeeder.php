<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Sector;

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

        $municipio5 =  Municipality::where('name', 'Las Yayas de Viajama')->first();
        $data = [
            [
                'municipality_id' => $municipio5->id,
                'name' => 'Villarpando',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio5->id,
                'name' => 'Hato Nuevo-Cortés',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $sector) {
            Sector::create($sector);
        }

        $municipio6 = Municipality::where('name', 'Padre Las Casas')->first();
        $data6 = [
            [
                'municipality_id' => $municipio6->id,
                'name' => 'La Siembra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio6->id,
                'name' => 'Las Lagunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio6->id,
                'name' => 'Los Fríos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data6 as $sector) {
            Sector::create($sector);
        }

        $municipio8 = Municipality::where('name', 'Pueblo Viejo')->first();
        $data8 = [
            [
                'municipality_id' => $municipio8->id,
                'name' => 'El Rosario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data8 as $sector) {
            Sector::create($sector);
        }

        $municipio9 = Municipality::where('name', 'Sabana Yegua')->first();
        $data9 = [
            [
                'municipality_id' => $municipio9->id,
                'name' => 'Proyecto 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio9->id,
                'name' => 'Ganadero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio9->id,
                'name' => 'Proyecto 2-C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data9 as $sector) {
            Sector::create($sector);
        }

        $municipio10 = Municipality::where('name', 'Tábara Arriba')->first();
        $data10 = [
            [
                'municipality_id' => $municipio10->id,
                'name' => 'Amiama Gómez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio10->id,
                'name' => 'Los Toros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio10->id,
                'name' => 'Tábaro Abajo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data10 as $sector) {
            Sector::create($sector);
        }


        $municipio11 = Municipality::where('name', 'Neiba')->first();
        $data11 = [
            [
                'municipality_id' => $municipio11->id,
                'name' => 'El Palmar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data11 as $sector) {
            Sector::create($sector);
        }
        
        $municipio12 = Municipality::where('name', 'Galván')->first();
        $data12 = [
            [
                'municipality_id' => $municipio12->id,
                'name' => 'El Salado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data12 as $sector) {
            Sector::create($sector);
        }
        
        $municipio13 = Municipality::where('name', 'Los Ríos')->first();
        $data13 = [
            [
                'municipality_id' => $municipio13->id,
                'name' => 'Las Clavellinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data13 as $sector) {
            Sector::create($sector);
        }
        
        $municipio14 = Municipality::where('name', 'Tamayo')->first();
        $data14 = [
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Cabeza de Toro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Mena',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Monserrat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Santa Bárbara-El 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio14->id,
                'name' => 'Uvilla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data14 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de Barahona
        $municipio15 = Municipality::where('name', 'Barahona')->first();
        $data15 = [
            [
                'municipality_id' => $municipio15->id,
                'name' => 'El Cachón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio15->id,
                'name' => 'La Guázara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio15->id,
                'name' => 'Villa Central',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data15 as $sector) {
            Sector::create($sector);
        }

        $municipio16 = Municipality::where('name', 'Enriquillo')->first();
        $data16 = [
            [
                'municipality_id' => $municipio16->id,
                'name' => 'Arroyo Dulce',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data16 as $sector) {
            Sector::create($sector);
        }

        $municipio17 = Municipality::where('name', 'Fundación')->first();
        $data17 = [
            [
                'municipality_id' => $municipio17->id,
                'name' => 'Pescadería',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data17 as $sector) {
            Sector::create($sector);
        }

        $municipio18 = Municipality::where('name', 'Jaquimeyes')->first();
        $data18 = [
            [
                'municipality_id' => $municipio18->id,
                'name' => 'Palo Alto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data18 as $sector) {
            Sector::create($sector);
        }

        $municipio19 = Municipality::where('name', 'La Ciénaga')->first();
        $data19 = [
            [
                'municipality_id' => $municipio19->id,
                'name' => 'Bahoruco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data19 as $sector) {
            Sector::create($sector);
        }

        $municipio20 = Municipality::where('name', 'Paraíso')->first();
        $data20 = [
            [
                'municipality_id' => $municipio20->id,
                'name' => 'Los Patos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data20 as $sector) {
            Sector::create($sector);
        }

        $municipio21 = Municipality::where('name', 'Vicente Noble')->first();
        $data21 = [
            [
                'municipality_id' => $municipio21->id,
                'name' => 'Canoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio21->id,
                'name' => 'Fondo Negro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio21->id,
                'name' => 'Quita Coraza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data21 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores adicionales
        $municipio22 = Municipality::where('name', 'Dajabón')->first();
        $data22 = [
            [
                'municipality_id' => $municipio22->id,
                'name' => 'Cañongo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data22 as $sector) {
            Sector::create($sector);
        }

        $municipio23 = Municipality::where('name', 'El Pino')->first();
        $data23 = [
            [
                'municipality_id' => $municipio23->id,
                'name' => 'Manuel Bueno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data23 as $sector) {
            Sector::create($sector);
        }

        $municipio24 = Municipality::where('name', 'Loma de Cabrera')->first();
        $data24 = [
            [
                'municipality_id' => $municipio24->id,
                'name' => 'Capotillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio24->id,
                'name' => 'Santiago de la Cruz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data24 as $sector) {
            Sector::create($sector);
        }

        $municipio25 = Municipality::where('name', 'San Francisco de Macorís')->first();
        $data25 = [
            [
                'municipality_id' => $municipio25->id,
                'name' => 'Cenoví',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio25->id,
                'name' => 'Jaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio25->id,
                'name' => 'La Peña',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio25->id,
                'name' => 'Presidente Don Antonio Guzmán Fernández',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data25 as $sector) {
            Sector::create($sector);
        }

        $municipio26 = Municipality::where('name', 'Arenoso')->first();
        $data26 = [
            [
                'municipality_id' => $municipio26->id,
                'name' => 'Aguacate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio26->id,
                'name' => 'Las Coles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data26 as $sector) {
            Sector::create($sector);
        }

        $municipio27 = Municipality::where('name', 'Eugenio María de Hostos')->first();
        $data27 = [
            [
                'municipality_id' => $municipio27->id,
                'name' => 'Sabana Grande',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data27 as $sector) {
            Sector::create($sector);
        }

        $municipio28 = Municipality::where('name', 'Villa Riva')->first();
        $data28 = [
            [
                'municipality_id' => $municipio28->id,
                'name' => 'Agua Santa del Yuna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio28->id,
                'name' => 'Barraquito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio28->id,
                'name' => 'Cristo Rey de Guaraguao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio28->id,
                'name' => 'Las Táranas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data28 as $sector) {
            Sector::create($sector);
        }

        $municipio29 = Municipality::where('name', 'El Seibo')->first();
        $data29 = [
            [
                'municipality_id' => $municipio29->id,
                'name' => 'Pedro Sánchez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio29->id,
                'name' => 'San Francisco-Vicentillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio29->id,
                'name' => 'Santa Lucía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data29 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio39 = Municipality::where('name', 'Miches')->first();
        $data39 = [
            [
                'municipality_id' => $municipio39->id,
                'name' => 'El Cedro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio39->id,
                'name' => 'La Gina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data39 as $sector) {
            Sector::create($sector);
        }

        $municipio40 = Municipality::where('name', 'Comendador')->first();
        $data40 = [
            [
                'municipality_id' => $municipio40->id,
                'name' => 'Guayabo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio40->id,
                'name' => 'Sabana Larga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data40 as $sector) {
            Sector::create($sector);
        }

        $municipio41 = Municipality::where('name', 'Bánica')->first();
        $data41 = [
            [
                'municipality_id' => $municipio41->id,
                'name' => 'Sabana Cruz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio41->id,
                'name' => 'Sabana Higüero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data41 as $sector) {
            Sector::create($sector);
        }

        $municipio42 = Municipality::where('name', 'El Llano')->first();
        $data42 = [
            [
                'municipality_id' => $municipio42->id,
                'name' => 'Guanito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data42 as $sector) {
            Sector::create($sector);
        }

        $municipio43 = Municipality::where('name', 'Hondo Valle')->first();
        $data43 = [
            [
                'municipality_id' => $municipio43->id,
                'name' => 'Rancho de la Guardia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data43 as $sector) {
            Sector::create($sector);
        }

        $municipio44 = Municipality::where('name', 'Pedro Santana')->first();
        $data44 = [
            [
                'municipality_id' => $municipio44->id,
                'name' => 'Río Limpio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data44 as $sector) {
            Sector::create($sector);
        }

        $municipio45 = Municipality::where('name', 'Moca')->first();
        $data45 = [
            [
                'municipality_id' => $municipio45->id,
                'name' => 'Canca La Reina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'El Higüerito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'José Contreras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'Juan López',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'La Ortega',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'Las Lagunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'Monte de la Jagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio45->id,
                'name' => 'San Víctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data45 as $sector) {
            Sector::create($sector);
        }

        $municipio46 = Municipality::where('name', 'Gaspar Hernández')->first();
        $data46 = [
            [
                'municipality_id' => $municipio46->id,
                'name' => 'Joba Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio46->id,
                'name' => 'Veragua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio46->id,
                'name' => 'Villa Magante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data46 as $sector) {
            Sector::create($sector);
        }

        $municipio47 = Municipality::where('name', 'Hato Mayor del Rey')->first();
        $data47 = [
            [
                'municipality_id' => $municipio47->id,
                'name' => 'Guayabo Dulce',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio47->id,
                'name' => 'Mata Palacio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio47->id,
                'name' => 'Yerba Buena',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data47 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio48 = Municipality::where('name', 'Sabana de la Mar')->first();
        $data48 = [
            [
                'municipality_id' => $municipio48->id,
                'name' => 'Elupina Cordero de Las Cañitas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data48 as $sector) {
            Sector::create($sector);
        }

        $municipio49 = Municipality::where('name', 'Salcedo')->first();
        $data49 = [
            [
                'municipality_id' => $municipio49->id,
                'name' => 'Jamao Afuera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data49 as $sector) {
            Sector::create($sector);
        }

        $municipio50 = Municipality::where('name', 'Tenares')->first();
        $data50 = [
            [
                'municipality_id' => $municipio50->id,
                'name' => 'Blanco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data50 as $sector) {
            Sector::create($sector);
        }

        $municipio51 = Municipality::where('name', 'Jimaní')->first();
        $data51 = [
            [
                'municipality_id' => $municipio51->id,
                'name' => 'Boca de Cachón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio51->id,
                'name' => 'El Limón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data51 as $sector) {
            Sector::create($sector);
        }

        $municipio52 = Municipality::where('name', 'Cristóbal')->first();
        $data52 = [
            [
                'municipality_id' => $municipio52->id,
                'name' => 'Batey 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data52 as $sector) {
            Sector::create($sector);
        }

        $municipio53 = Municipality::where('name', 'Duvergé')->first();
        $data53 = [
            [
                'municipality_id' => $municipio53->id,
                'name' => 'Vengan a Ver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data53 as $sector) {
            Sector::create($sector);
        }

        $municipio54 = Municipality::where('name', 'Mella')->first();
        $data54 = [
            [
                'municipality_id' => $municipio54->id,
                'name' => 'La Colonia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data54 as $sector) {
            Sector::create($sector);
        }

        $municipio55 = Municipality::where('name', 'Postrer Río')->first();
        $data55 = [
            [
                'municipality_id' => $municipio55->id,
                'name' => 'Guayabal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data55 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio56 = Municipality::where('name', 'Higüey')->first();
        $data56 = [
            [
                'municipality_id' => $municipio56->id,
                'name' => 'La Otra Banda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio56->id,
                'name' => 'Lagunas de Nisibón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio56->id,
                'name' => 'Verón-Punta Cana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data56 as $sector) {
            Sector::create($sector);
        }

        $municipio57 = Municipality::where('name', 'San Rafael del Yuma')->first();
        $data57 = [
            [
                'municipality_id' => $municipio57->id,
                'name' => 'Bayahibe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio57->id,
                'name' => 'Boca de Yuma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data57 as $sector) {
            Sector::create($sector);
        }

        $municipio58 = Municipality::where('name', 'La Romana')->first();
        $data58 = [
            [
                'municipality_id' => $municipio58->id,
                'name' => 'Caleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data58 as $sector) {
            Sector::create($sector);
        }

        $municipio59 = Municipality::where('name', 'Villa Hermosa')->first();
        $data59 = [
            [
                'municipality_id' => $municipio59->id,
                'name' => 'Cumayasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data59 as $sector) {
            Sector::create($sector);
        }

        $municipio60 = Municipality::where('name', 'La Concepción de La Vega')->first();
        $data60 = [
            [
                'municipality_id' => $municipio60->id,
                'name' => 'El Ranchito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio60->id,
                'name' => 'Río Verde Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data60 as $sector) {
            Sector::create($sector);
        }

        $municipio61 = Municipality::where('name', 'Constanza')->first();
        $data61 = [
            [
                'municipality_id' => $municipio61->id,
                'name' => 'La Sabina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio61->id,
                'name' => 'Tireo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data61 as $sector) {
            Sector::create($sector);
        }

        $municipio62 = Municipality::where('name', 'Jarabacoa')->first();
        $data62 = [
            [
                'municipality_id' => $municipio62->id,
                'name' => 'Buena Vista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio62->id,
                'name' => 'Manabao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data62 as $sector) {
            Sector::create($sector);
        }

        $municipio63 = Municipality::where('name', 'Jima Abajo')->first();
        $data63 = [
            [
                'municipality_id' => $municipio63->id,
                'name' => 'Rincón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data63 as $sector) {
            Sector::create($sector);
        }

        $municipio64 = Municipality::where('name', 'Nagua')->first();
        $data64 = [
            [
                'municipality_id' => $municipio64->id,
                'name' => 'Arroyo al Medio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio64->id,
                'name' => 'Las Gordas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio64->id,
                'name' => 'San José de Matanzas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data64 as $sector) {
            Sector::create($sector);
        }

        $municipio65 = Municipality::where('name', 'Cabrera')->first();
        $data65 = [
            [
                'municipality_id' => $municipio65->id,
                'name' => 'Arroyo Salado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio65->id,
                'name' => 'La Entrada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data65 as $sector) {
            Sector::create($sector);
        }

        $municipio66 = Municipality::where('name', 'El Factor')->first();
        $data66 = [
            [
                'municipality_id' => $municipio66->id,
                'name' => 'El Pozo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data66 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio67 = Municipality::where('name', 'Bonao')->first();
        $data67 = [
            [
                'municipality_id' => $municipio67->id,
                'name' => 'Arroyo Toro-Masipedro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio67->id,
                'name' => 'La Salvia-Los Quemados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio67->id,
                'name' => 'Jayaco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio67->id,
                'name' => 'Juma Bejucal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio67->id,
                'name' => 'Sabana del Puerto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data67 as $sector) {
            Sector::create($sector);
        }

        $municipio68 = Municipality::where('name', 'Piedra Blanca')->first();
        $data68 = [
            [
                'municipality_id' => $municipio68->id,
                'name' => 'Juan Adrián',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio68->id,
                'name' => 'Villa Sonador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data68 as $sector) {
            Sector::create($sector);
        }

        $municipio69 = Municipality::where('name', 'Castañuela')->first();
        $data69 = [
            [
                'municipality_id' => $municipio69->id,
                'name' => 'Palo Verde',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data69 as $sector) {
            Sector::create($sector);
        }

        $municipio70 = Municipality::where('name', 'Guayubín')->first();
        $data70 = [
            [
                'municipality_id' => $municipio70->id,
                'name' => 'Cana Chapetón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio70->id,
                'name' => 'Hatillo Palma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio70->id,
                'name' => 'Villa Elisa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data70 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio71 = Municipality::where('name', 'Monte Plata')->first();
        $data71 = [
            [
                'municipality_id' => $municipio71->id,
                'name' => 'Boyá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio71->id,
                'name' => 'Chirino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio71->id,
                'name' => 'Don Juan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data71 as $sector) {
            Sector::create($sector);
        }

        $municipio72 = Municipality::where('name', 'Sabana Grande de Boyá')->first();
        $data72 = [
            [
                'municipality_id' => $municipio72->id,
                'name' => 'Gonzalo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio72->id,
                'name' => 'Majagual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data72 as $sector) {
            Sector::create($sector);
        }

        $municipio73 = Municipality::where('name', 'Yamasá')->first();
        $data73 = [
            [
                'municipality_id' => $municipio73->id,
                'name' => 'Los Botados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data73 as $sector) {
            Sector::create($sector);
        }

        $municipio74 = Municipality::where('name', 'Pedernales')->first();
        $data74 = [
            [
                'municipality_id' => $municipio74->id,
                'name' => 'José Francisco Peña Gómez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio74->id,
                'name' => 'Juancho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data74 as $sector) {
            Sector::create($sector);
        }

        $municipio75 = Municipality::where('name', 'Baní')->first();
        $data75 = [
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Catalina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'El Carretón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'El Limonal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Las Barías',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Matanzas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Paya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Sabana Buey',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Villa Fundación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio75->id,
                'name' => 'Villa Sombrero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data75 as $sector) {
            Sector::create($sector);
        }

        $municipio76 = Municipality::where('name', 'Nizao')->first();
        $data76 = [
            [
                'municipality_id' => $municipio76->id,
                'name' => 'Pizarrete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio76->id,
                'name' => 'Santana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data76 as $sector) {
            Sector::create($sector);
        }

        $municipio77 = Municipality::where('name', 'Puerto Plata')->first();
        $data77 = [
            [
                'municipality_id' => $municipio77->id,
                'name' => 'Maimón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio77->id,
                'name' => 'Yásica Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data77 as $sector) {
            Sector::create($sector);
        }

        $municipio78 = Municipality::where('name', 'Altamira')->first();
        $data78 = [
            [
                'municipality_id' => $municipio78->id,
                'name' => 'Río Grande',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data78 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio79 = Municipality::where('name', 'Los Hidalgos')->first();
        $data79 = [
            [
                'municipality_id' => $municipio79->id,
                'name' => 'Navas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data79 as $sector) {
            Sector::create($sector);
        }

        $municipio80 = Municipality::where('name', 'Luperón')->first();
        $data80 = [
            [
                'municipality_id' => $municipio80->id,
                'name' => 'Belloso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio80->id,
                'name' => 'Estrecho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio80->id,
                'name' => 'La Isabela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data80 as $sector) {
            Sector::create($sector);
        }

        $municipio81 = Municipality::where('name', 'Sosúa')->first();
        $data81 = [
            [
                'municipality_id' => $municipio81->id,
                'name' => 'Cabarete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio81->id,
                'name' => 'Sabaneta de Yásica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data81 as $sector) {
            Sector::create($sector);
        }

        $municipio82 = Municipality::where('name', 'Villa Isabela')->first();
        $data82 = [
            [
                'municipality_id' => $municipio82->id,
                'name' => 'Estero Hondo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio82->id,
                'name' => 'Gualete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio82->id,
                'name' => 'La Jaiba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data82 as $sector) {
            Sector::create($sector);
        }

        $municipio83 = Municipality::where('name', 'Samaná')->first();
        $data83 = [
            [
                'municipality_id' => $municipio83->id,
                'name' => 'Arroyo Barril',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio83->id,
                'name' => 'El Limón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio83->id,
                'name' => 'Las Galeras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data83 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio84 = Municipality::where('name', 'San Cristóbal')->first();
        $data84 = [
            [
                'municipality_id' => $municipio84->id,
                'name' => 'Hato Damas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data84 as $sector) {
            Sector::create($sector);
        }

        $municipio85 = Municipality::where('name', 'Bajos de Haina')->first();
        $data85 = [
            [
                'municipality_id' => $municipio85->id,
                'name' => 'El Carril',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data85 as $sector) {
            Sector::create($sector);
        }

        $municipio86 = Municipality::where('name', 'Cambita Garabito')->first();
        $data86 = [
            [
                'municipality_id' => $municipio86->id,
                'name' => 'Cambita El Pueblecito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data86 as $sector) {
            Sector::create($sector);
        }

        $municipio87 = Municipality::where('name', 'Villa Altagracia')->first();
        $data87 = [
            [
                'municipality_id' => $municipio87->id,
                'name' => 'La Cuchilla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio87->id,
                'name' => 'Medina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio87->id,
                'name' => 'San José del Puerto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data87 as $sector) {
            Sector::create($sector);
        }

        $municipio88 = Municipality::where('name', 'San José de Ocoa')->first();
        $data88 = [
            [
                'municipality_id' => $municipio88->id,
                'name' => 'El Naranjal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio88->id,
                'name' => 'El Pinar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio88->id,
                'name' => 'La Ciénaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio88->id,
                'name' => 'Nizao-Las Auyamas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data88 as $sector) {
            Sector::create($sector);
        }

        $municipio89 = Municipality::where('name', 'San Juan de la Maguana')->first();
        $data89 = [
            [
                'municipality_id' => $municipio89->id,
                'name' => 'El Rosario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Guanito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Hato del Padre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Hato Nuevo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'La Jagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Las Charcas de María Nova',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Pedro Corto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Sabana Alta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio89->id,
                'name' => 'Sabaneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data89 as $sector) {
            Sector::create($sector);
        }

        $municipio90 = Municipality::where('name', 'Bohechío')->first();
        $data90 = [
            [
                'municipality_id' => $municipio90->id,
                'name' => 'Arroyo Cano',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio90->id,
                'name' => 'Yaque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data90 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio91 = Municipality::where('name', 'El Cercado')->first();
        $data91 = [
            [
                'municipality_id' => $municipio91->id,
                'name' => 'Batista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio91->id,
                'name' => 'Derrumbadero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data91 as $sector) {
            Sector::create($sector);
        }

        $municipio92 = Municipality::where('name', 'Juan de Herrera')->first();
        $data92 = [
            [
                'municipality_id' => $municipio92->id,
                'name' => 'Jínova',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data92 as $sector) {
            Sector::create($sector);
        }

        $municipio93 = Municipality::where('name', 'Las Matas de Farfán')->first();
        $data93 = [
            [
                'municipality_id' => $municipio93->id,
                'name' => 'Carrera de Yegua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio93->id,
                'name' => 'Matayaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data93 as $sector) {
            Sector::create($sector);
        }

        $municipio94 = Municipality::where('name', 'Vallejuelo')->first();
        $data94 = [
            [
                'municipality_id' => $municipio94->id,
                'name' => 'Jorjillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data94 as $sector) {
            Sector::create($sector);
        }

        $municipio95 = Municipality::where('name', 'San José de Los Llanos')->first();
        $data95 = [
            [
                'municipality_id' => $municipio95->id,
                'name' => 'El Puerto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio95->id,
                'name' => 'Gautier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data95 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio96 = Municipality::where('name', 'Cotuí')->first();
        $data96 = [
            [
                'municipality_id' => $municipio96->id,
                'name' => 'Caballero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio96->id,
                'name' => 'Comedero Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio96->id,
                'name' => 'Quita Sueño',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data96 as $sector) {
            Sector::create($sector);
        }

        $municipio97 = Municipality::where('name', 'Cevicos')->first();
        $data97 = [
            [
                'municipality_id' => $municipio97->id,
                'name' => 'La Cueva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio97->id,
                'name' => 'Platanal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data97 as $sector) {
            Sector::create($sector);
        }

        $municipio98 = Municipality::where('name', 'La Mata')->first();
        $data98 = [
            [
                'municipality_id' => $municipio98->id,
                'name' => 'Angelina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio98->id,
                'name' => 'La Bija',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio98->id,
                'name' => 'Hernando Alonzo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data98 as $sector) {
            Sector::create($sector);
        }

        $municipio99 = Municipality::where('name', 'Santiago')->first();
        $data99 = [
            [
                'municipality_id' => $municipio99->id,
                'name' => 'Baitoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio99->id,
                'name' => 'Hato del Yaque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio99->id,
                'name' => 'La Canela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio99->id,
                'name' => 'Pedro García',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio99->id,
                'name' => 'San Francisco de Jacagua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data99 as $sector) {
            Sector::create($sector);
        }

        $municipio100 = Municipality::where('name', 'Jánico')->first();
        $data100 = [
            [
                'municipality_id' => $municipio100->id,
                'name' => 'El Caimito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio100->id,
                'name' => 'Juncalito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data100 as $sector) {
            Sector::create($sector);
        }

        $municipio101 = Municipality::where('name', 'Licey al Medio')->first();
        $data101 = [
            [
                'municipality_id' => $municipio101->id,
                'name' => 'Las Palomas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data101 as $sector) {
            Sector::create($sector);
        }

        $municipio102 = Municipality::where('name', 'San José de las Matas')->first();
        $data102 = [
            [
                'municipality_id' => $municipio102->id,
                'name' => 'El Rubio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio102->id,
                'name' => 'La Cuesta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio102->id,
                'name' => 'Las Placetas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data102 as $sector) {
            Sector::create($sector);
        }

        $municipio103 = Municipality::where('name', 'Tamboril')->first();
        $data103 = [
            [
                'municipality_id' => $municipio103->id,
                'name' => 'Canca La Piedra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data103 as $sector) {
            Sector::create($sector);
        }

        $municipio104 = Municipality::where('name', 'Villa González')->first();
        $data104 = [
            [
                'municipality_id' => $municipio104->id,
                'name' => 'El Limón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio104->id,
                'name' => 'Palmar Arriba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data104 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio105 = Municipality::where('name', 'Santo Domingo Este')->first();
        $data105 = [
            [
                'municipality_id' => $municipio105->id,
                'name' => 'San Luis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data105 as $sector) {
            Sector::create($sector);
        }

        $municipio106 = Municipality::where('name', 'Boca Chica')->first();
        $data106 = [
            [
                'municipality_id' => $municipio106->id,
                'name' => 'La Caleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data106 as $sector) {
            Sector::create($sector);
        }

        $municipio107 = Municipality::where('name', 'Los Alcarrizos')->first();
        $data107 = [
            [
                'municipality_id' => $municipio107->id,
                'name' => 'Palmarejo-Villa Linda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio107->id,
                'name' => 'Pantoja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data107 as $sector) {
            Sector::create($sector);
        }

        $municipio108 = Municipality::where('name', 'Pedro Brand')->first();
        $data108 = [
            [
                'municipality_id' => $municipio108->id,
                'name' => 'La Cuaba',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio108->id,
                'name' => 'La Guáyiga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data108 as $sector) {
            Sector::create($sector);
        }

        $municipio109 = Municipality::where('name', 'San Antonio de Guerra')->first();
        $data109 = [
            [
                'municipality_id' => $municipio109->id,
                'name' => 'Hato Viejo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data109 as $sector) {
            Sector::create($sector);
        }

        $municipio110 = Municipality::where('name', 'Santo Domingo Norte')->first();
        $data110 = [
            [
                'municipality_id' => $municipio110->id,
                'name' => 'La Victoria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data110 as $sector) {
            Sector::create($sector);
        }

        // Municipios y sectores de la nueva imagen
        $municipio111 = Municipality::where('name', 'Mao')->first();
        $data111 = [
            [
                'municipality_id' => $municipio111->id,
                'name' => 'Ámina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio111->id,
                'name' => 'Guatapanal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio111->id,
                'name' => 'Jaibón (Pueblo Nuevo)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data111 as $sector) {
            Sector::create($sector);
        }

        $municipio112 = Municipality::where('name', 'Esperanza')->first();
        $data112 = [
            [
                'municipality_id' => $municipio112->id,
                'name' => 'Boca de Mao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio112->id,
                'name' => 'Jicomé',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio112->id,
                'name' => 'Maizal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio112->id,
                'name' => 'Paradero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data112 as $sector) {
            Sector::create($sector);
        }

        $municipio113 = Municipality::where('name', 'Laguna Salada')->first();
        $data113 = [
            [
                'municipality_id' => $municipio113->id,
                'name' => 'Cruce de Guayacanes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio113->id,
                'name' => 'Jaibón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'municipality_id' => $municipio113->id,
                'name' => 'La Caya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data113 as $sector) {
            Sector::create($sector);
        }

        
    }
}
