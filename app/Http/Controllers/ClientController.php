<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Address;
use App\Models\Contact;

class ClientController extends Controller
{
    public function index(Request $request) {
        $query = Client::query();

        $query->when($request->filled('codigo'), function ($q) use ($request) {
            $codigoLimpo = preg_replace('/\D/', '', $request->codigo);
            $q->where('id', 'like', '%' . $codigoLimpo . '%');
        });

        $query->when($request->filled('nome'), function ($q) use ($request) {
            $termo = $request->nome;
            $q->where('name', 'ilike', '%' . $termo . '%');
        });

        $query->when($request->filled('cnpj'), function ($q) use ($request) {
            $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
            $q->where('cnpj', 'like', '%' . $cnpjLimpo . '%');
        });

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $query->orderBy($sort, $direction);

        $clients = $query->paginate(5)->withQueryString();

        $sequence = DB::select("SELECT last_value FROM pg_sequences WHERE sequencename = 'clients_id_seq'");
        $nextId = (!empty($sequence) && $sequence[0]->last_value !== null) ? $sequence[0]->last_value + 1 : 1;
        $codigoPad = str_pad($nextId, 6, '0', STR_PAD_LEFT);
        $proximoIdFormatado = substr($codigoPad, 0, 3) . '.' . substr($codigoPad, 3, 3);

        return view('clientes.index', compact('clients', 'proximoIdFormatado'));
    }

    public function store(StoreClientRequest $request) {
        try {
            DB::transaction(function () use ($request) {

                $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
                $cepLimpo = $request->cep ? preg_replace('/\D/', '', $request->cep) : null;

                $client = Client::create([
                    'name' => $request->name,
                    'cnpj' => $cnpjLimpo,
                    'rg'   => $request->rg,
                    'born' => $request->born,
                    'observation' => $request->observation,
                ]);

                Address::create([
                    'client_id' => $client->id,
                    'address' => $request->address,
                    'complement' => $request->complement,
                    'neighborhood' => $request->neighborhood,
                    'city' => $request->city,
                    'cep' => $cepLimpo,
                    'uf' => $request->uf,
                ]);

                Contact::create([
                    'client_id' => $client->id,
                    'telephone' => $request->telephone,
                    'cellphone' => $request->cellphone,
                ]);
            });

            return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['erro_geral' => 'Erro ao salvar cliente: ' . $e->getMessage()]);
        }
    } 

    public function update(StoreClientRequest $request, $id) {
        try {
            $client = Client::findOrFail($id);

            DB::transaction(function () use ($request, $client) {

                $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
                $cepLimpo = $request->cep ? preg_replace('/\D/', '', $request->cep) : null;

                $client->update([
                    'name' => $request->name,
                    'cnpj' => $cnpjLimpo,
                    'rg'   => $request->rg,
                    'born' => $request->born,
                    'observation' => $request->observation,
                ]);

                $client->address()->update([
                    'client_id' => $client->id,
                    'address' => $request->address,
                    'complement' => $request->complement,
                    'neighborhood' => $request->neighborhood,
                    'city' => $request->city,
                    'cep' => $cepLimpo,
                    'uf' => $request->uf,
                ]);

                $client->contact()->update([
                    'client_id' => $client->id,
                    'telephone' => $request->telephone,
                    'cellphone' => $request->cellphone,
                ]);
            });

            return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['erro_geral' => 'Erro ao atualizar cliente: ' . $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $client = Client::findOrFail($id);

        DB::transaction(function () use ($client) {
            $client->address()->delete();
            $client->contact()->delete();
            $client->delete();
        });

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído');
    }
}
