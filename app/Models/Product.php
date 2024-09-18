<?php

namespace App\Models;

use App\Contracts\Postable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product  extends Model implements Postable
{
    use HasFactory;

    protected $fillable = [

        'name',
        'image',

        'lot_number',
        'country',
        'city',
        'meter',
        'serial_number',
        'features',
        'note',
        'year',
        'manufacturer',
        'asset_type',
        'appearance',
        'general',
        'function',
        'dimension',
        'actual_price',
        'bid_price',
        'status',
        'equipmentcategory_id',
        'subcategory_id',
        'auctiontype_id',
        'vendor_id',


    ];

    public function toArray()
    {
        return [
            'id' => $this->id, // Include the ID
            'name'=> $this->name,
            'lot_number'=> $this->lot_number,
            'image'=> $this->image,

            'country'=> $this->country,
            'city'=> $this->city,
            'meter'=> $this->meter,
            'serial_number'=> $this->serial_number,
            'features'=> $this->features,
            'note'=> $this->note,
            'year'=> $this->year,
            'manufacturer'=> $this->manufacturer,
            'asset_type'=> $this->asset_type,
            'appearance'=> $this->appearance,
            'general'=> $this->general,
            'function'=> $this->function,
            'dimension'=> $this->dimension,
            'actual_price'=> $this->actual_price,
            'bid_price'=> $this->bid_price,
            'status'=> $this->status,
            'equipmentcategory_id'=> $this->equipmentcategory_id,
            'subcategory_id'=> $this->subcategory_id,

        ];
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');  // Make sure this matches your actual foreign key column
    }
}
