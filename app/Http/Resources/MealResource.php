<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "status" => 200,
            'meta' => [
            "currentPage" => $this['pagination_data']->currentPage(),
            'totalItems' => $this['pagination_data']->total(),
            "itemsPerPage" => $this['pagination_data']->perPage(),
            "totalPages" => $this['pagination_data']->lastPage(),
            ],
            "data" => $this['data'],
            "links" => [
                    "prev" => ($this['pagination_data']->currentPage() != 1) ? $this['pagination_data']->previousPageUrl() : null,
                    "next" => ($this['pagination_data']->currentPage() != $this['pagination_data']->lastPage()) ? $this['pagination_data']->nextPageUrl() : null,
                    "self" => $this['pagination_data']->url($this['pagination_data']->currentPage()),
            ],
        ];
    }
}
