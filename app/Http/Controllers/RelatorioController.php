<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function index() {
        $clientes = Client::all();

        return view('relatorios.index', compact('clientes'));
    }

    public function imprimir(Request $request) {
        $termo = $request->input('cliente_id');
        $query = \App\Models\Client::query();

        if ($termo) {
            if (is_numeric($termo)) {
                $query->where('id', $termo);
            } else {
                $query->where(function($q) use ($termo) {
                    $q->where('name', 'ilike', '%' . $termo . '%')
                    ->orWhere('cnpj', 'like', '%' . $termo . '%');
                });
            }
        }

        $clientesParaRelatorio = $query->get();

        if ($clientesParaRelatorio->isEmpty()) {
            return back()->with('error', 'Nenhum cliente encontrado.');
        }

        $pdf = Pdf::loadView('relatorios.pdf', compact('clientesParaRelatorio'));
        return $pdf->stream('relatorio_clientes.pdf');
    }
}
