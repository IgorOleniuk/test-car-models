<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandConfirmationToken extends Model
{
    use HasFactory;

    protected $fillable = ['confirmation_token'];
}
