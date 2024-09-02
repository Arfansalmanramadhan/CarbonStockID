<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'registrasi_id' => $this->whenLoaded("user"),
            'namadepan' => $this->namadepan,
            'namabelakang' => $this->namabelakang,
            'no_hp' => $this->no_hp
        ];
    }
}
