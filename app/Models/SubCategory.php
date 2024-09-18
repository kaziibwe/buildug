<?php

namespace App\Models;

use App\Contracts\Postable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model implements Postable
{
    use HasFactory;

    protected $fillable = ['name','image','category_id', 'active', 'featured'];

    public function toArray()
    {
        return [
            'id' => $this->id, // Include the ID
            'name' => $this->name,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'active' => $this->active,
            'featured' => $this->featured,
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');  // Ensure this is the correct foreign key
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
