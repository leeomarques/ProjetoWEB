<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * php artisan db:seed executa
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasSeeder::class);
    }
}
