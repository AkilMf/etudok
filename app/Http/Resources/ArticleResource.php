<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => isset ($this->titre[app()->getLocale()]) ? $this->titre[app()->getLocale()] : $this->titre['en'],  //app()->getLocale() : en OR fr
            'contenu' => isset ($this->contenu[app()->getLocale()]) ? $this->contenu[app()->getLocale()] : $this->contenu['en'],
            'date' => $this->date,
            'etudiant' => $this->etudiant->user->name, // nom||name etudiant viens des relations entre les 3 tables
            'etudiant_id' => $this->etudiant_id

        ];
        //Jui@@145

    }
}
