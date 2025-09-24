<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            'Distrito Nacional',
            'Azua',
            'Baoruco',
            'Barahona',
            'Dajabón',
            'Duarte',
            'El Seibo',
            'Elías Piña',
            'Espaillat',
            'Hato Mayor',
            'Hermanas Mirabal',
            'Independencia',
            'La Altagracia',
            'La Romana',
            'La Vega',
            'María Trinidad Sánchez',
            'Monseñor Nouel',
            'Montecristi',
            'Monte Plata',
            'Pedernales',
            'Peravia',
            'Puerto Plata',
            'Samaná',
            'San Cristóbal',
            'San José de Ocoa',
            'San Juan',
            'San Pedro de Macorís',
            'Sánchez Ramírez',
            'Santiago',
            'Santiago Rodríguez',
            'Santo Domingo',
            'Valverde',
        ];

        foreach ($data as $province) {
            Province::create(['name' => $province, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
