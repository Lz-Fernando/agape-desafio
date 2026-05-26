<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cnpj', 'rg', 'born', 'observation'];

    public function address() {
        return $this->hasOne(Address::class);
    }

    public function contact() {
        return $this->hasOne(Contact::class);
    }

    public function getCodigoFormatadoAttribute() {
        $codigo = str_pad($this->id, 6, '0', STR_PAD_LEFT);
        
        return substr($codigo, 0, 3) . '.' . substr($codigo, 3, 3);
    }

    public function getCnpjFormatadoAttribute() {
        $cnpj = $this->cnpj;

        if (strlen($cnpj) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
        }

        return $cnpj;
    }
}
