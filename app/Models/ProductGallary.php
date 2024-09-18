<?php

namespace App\Models;

use App\Contracts\Postable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallary extends Model implements Postable
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id'
    ];

    public function toArray()
    {
        return [
            'id' => $this->id, // Include the ID
            'image'=> $this->image,
            'product_id'=> $this->product_id

        ];
    }
}
