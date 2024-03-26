<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fichier;



class Etudiant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }


    protected $fillable = [

        'adresse',
        'telephone',
        'ville_id',
        'date_naissance',
        'id'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }


}
