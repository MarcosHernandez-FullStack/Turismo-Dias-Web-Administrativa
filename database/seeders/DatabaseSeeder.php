<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(AmbienteSeeder::class);
        $this->call(TipoBusSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(InstitucionalSeeder::class);
        $this->call(ValorSeeder::class);
        $this->call(LibroReclamacionSeeder::class);
    }
}
