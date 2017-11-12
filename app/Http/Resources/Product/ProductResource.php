<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $rating = $this->reviews->count() ? round($this->reviews->sum('star')/$this->reviews->count(),2) : null;
        $stock = $this->stock ?: 'Out of stock';

        return [
            'name' => $this->name,
            'description' => $this->detail,
            'stock' => $stock,
            'price' => $this->price,
            'discount' => $this->discount,
            'discountedPrice' => round((1 - ($this->discount/100)) * $this->price , 2),
            'rating' => $rating,
            'href' => route('products.show', $this->id),
            'reviews' => route('reviews.index', $this->id)
        ];
    }
}
