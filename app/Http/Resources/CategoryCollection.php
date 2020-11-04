<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($category){
                return [
                    'category_id' => $category->category_id,
                    'category_title' => $category->category_title,
                    'category_name' => $category->category_name,
                    'parent_id' => $category->parent_id,
                    'rank_order' => $category->rank_order,
                    'registered_date' => $category->registered_date,
                ];
            })
        ];
    }
}
