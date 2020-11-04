<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($product){
                return [
                    'product_id' => $product->product_id,
                    'product_title' => $product->product_title,
                    'product_name' => $product->product_name,
                    'folder' => $product->folder,
                    'sku' => $product->sku,
                    'purchase_price' => $product->purchase_price,
                    'product_stock' => $product->product_stock,
                    'created_time' => $product->created_time,
                    'product_price' => $product->product_price,
                    'discount_price' => $product->discount_price,
                    'feasured_image' => $product->feasured_image,
                ];
            })
        ];
    }
}
