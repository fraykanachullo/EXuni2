<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        File::deleteDirectory('public/storage/galery');
        File::deleteDirectory('public/storage/documentos');
        File::deleteDirectory('public/storage/livewire-tmp');
        File::deleteDirectory('public/storage/profile-photos');
        File::makeDirectory('public/storage/galery');
        File::makeDirectory('public/storage/documentos');
        Storage::deleteDirectory('galery');
        Storage::deleteDirectory('documentos');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(EmpresaSeeder::class);
        // $this->call(OfertaLaboralSeeder::class);

    }
}
