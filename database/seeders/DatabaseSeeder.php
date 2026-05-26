<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['identifier' => '00000123'],
            [
                'password' => hash::make('Mudar123!'),
            ]
        );

        $client = Client::firstOrCreate(
            ['cnpj' => '18304485000172'],
            [
                'name' => 'Fernando',
                'rg' => '195365641',
                'born' => '2003-04-13',
                'observation' => 'Usuario inicial padrão',
            ]
        );

        Address::firstOrCreate(
            ['client_id' => $client->id], 
            [
                'address' => 'Rua Fernando Ribeiro',
                'complement' => 'apartamento',
                'neighborhood' => 'jabotiana',
                'cep' => '49026291',
                'city' => 'Aracaju',
                'uf' => 'SE',
            ]
        );

        Contact::firstOrCreate(
            ['client_id' => $client->id], 
            [
                'telephone' => '0000000000000',
                'cellphone' => '(75)9 9133-8575',
            ]
        );
    }
}
