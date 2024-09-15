<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TanahResource extends JsonResource
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
            'kedalaman_sample' => $this->kedalaman_sample,
            'berat_jenis_tanah' => $this->berat_jenis_tanah,
            'C_organic_tanah' => $this->C_organic_tanah,
            'carbongr' => $this->carbongr,
            'carbonton' => $this->carbonton,
            'carbonkg' => $this->carbonkg,
            'co2kg' => $this->co2kg,
        ];
    }
}
