<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon; 

class Product extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable = ['name', 'price', 'category_id', 'stock', 'image_path', 'description', 'slug'];
    protected $dates = ['deleted_at'];

    public function transform($data)
    {
        $products = [];
        foreach ($data as $item) {
            $added = new Carbon($item->created_at);
            array_push($products, [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'category_id' => $item->category_id,
                'categories' => [
                    0 => Category::where('id', $item->category_id)->first()->name
                ],
                'stock' => $item->stock,
                'image' => $item->image,
                'description' => $item->description,
                'added' => $added->toFormattedDateString()
            ]);
        }     
        return $products;
    }
}
