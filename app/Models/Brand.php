<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Brand extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = ['brand'];

    protected $searchable = [
        'columns' => [
            'brand' => 10
        ]
    ];

    /**
     * Relationships
     */
    public function car_models()
    {
        return $this->hasMany(CarModel::class);
    }

    public function token()
    {
        return $this->hasOne(BrandConfirmationToken::class);
    }
}
