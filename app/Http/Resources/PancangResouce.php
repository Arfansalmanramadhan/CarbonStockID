<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PancangResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
    public function toArray(Request $request): array
    {
        return [
            "id" =>$this->id,
            "keliling" =>$this->keliling,
            "diameter" =>$this->diameter,
            "nama_lokal" =>$this->nama_lokal,
            "nama_ilmiah" =>$this->nama_ilmiah,
            "kerapatan_jenis_kayu" =>$this->kerapatan_jenis_kayu,
            "bio_di_atas_tanah" =>$this->bio_di_atas_tanah,
            "kandungan_karbon" =>$this->kandungan_karbon,
            "co2" =>$this->co2,
        ];
    }
}
