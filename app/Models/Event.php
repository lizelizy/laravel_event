<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Para vários itens em um array
    protected $casts = [
        'items' => 'array'
    ];

    // Para datas
    protected $dates = ['date'];

    // Para o ID do dono
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Tudo que é enviado pelo post pode ser atualizado sem restrições
    protected $guarded = [];

    // Para o ID do dono// Para o ID do dono
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }    
    
}