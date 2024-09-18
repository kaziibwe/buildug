<?php

namespace App\Models;

use App\Contracts\Postable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements Postable
{
    use HasFactory;

    protected $fillable = ['name', 'active', 'featured'];

    public function toArray()
    {
        return [
            'id' => $this->id, // Include the ID
            'name' => $this->name,
            'active' => $this->active,
            'featured' => $this->featured,
        ];
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

}
