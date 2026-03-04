<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tieu_de' => $this->title,
            'mo_ta' => $this->description,
            'trang_thai' => $this->status,
            'phan_tram' => $this->progress_percent . '%', // Thêm định dạng cho đẹp
            'ngay_tao' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}