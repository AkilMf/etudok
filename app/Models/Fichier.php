<?php

namespace App\Models;

use App\Http\Resources\FichierResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Fichier extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'date', 'file', 'etudiant_id'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    protected function titre(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }

    static public function fichiers()
    {
        $resource = FichierResource::collection(self::select()->orderBy('titre')->get());
        $data = json_encode($resource);
        return json_decode($data, true);
    }

}
