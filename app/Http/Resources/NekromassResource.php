<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NekromassResource extends JsonResource
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
            'diameter_pangkal' => $this->diameter_pangkal,
            'diameter_ujung' => $this->diameter_ujung,
            'panjang' => $this->panjang,
            'volume' => $this->volume,
            'berat_jenis_kayu' => $this->berat_jenis_kayu,
            'biomasa' => $this->biomasa,
            'carbon' => $this->carbon,
            'co2' => $this->co2,
        ];
    }
}
