<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['brand'];

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
