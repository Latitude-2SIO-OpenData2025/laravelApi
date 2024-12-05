<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    protected $table = 'metiers'; // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire
    public $timestamps = false; // Si tu ne veux pas que Laravel gère les timestamps (created_at, updated_at)

    // Liste des champs que tu veux pouvoir modifier
    protected $fillable = [
        'code_metier',
        'nom_usuel',
        'adresse',
        'code_postal',
        'code_insee',
        'code_dpt',
        'code_reg',
        'nom_commune',
        'x_wgs84',
        'y_wgs84',
    ];
}
