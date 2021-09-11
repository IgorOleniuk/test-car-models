<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class CarModel extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = ['car_model'];

    // define which column should be searchable
    protected $searchable = [
        'columns' => [
            'car_model' => 10
        ]
    ];

    /**
     * Relationships
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
