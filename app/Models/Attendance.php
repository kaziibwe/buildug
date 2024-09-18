<?php

namespace App\Models;

use App\Contracts\Postable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model implements Postable
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'status'];

    public function toArray()
    {
        return [
            'id' => $this->id, // Include the ID
            'user_id' => $this->user_id,
            'date' => $this->date,
            'status' => $this->status,
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
