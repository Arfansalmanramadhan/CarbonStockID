<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerasahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "total_berat_basah" => $this->total_berat_basah,
            "sample_berat_basah" => $this->sample_berat_basah,
            "sample_berat_kering" => $this->sample_berat_kering,
            "total_berat_kering" => $this->total_berat_kering,
            "kandungan_karbon" => $this->kandungan_karbon,
            "co2" => $this->co2,
        ];
    }
}
