<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Resources\ArticleResource;


class Article extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu', 'date', 'etudiant_id'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    // getters $ setters pour les attributs titre & contenu :)
    protected function titre(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }

    protected function contenu(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }

    static public function articles()
    {
        $resource = ArticleResource::collection(self::select()->orderBy('titre')->get());
        $data = json_encode($resource);
        return json_decode($data, true);
    }




}
