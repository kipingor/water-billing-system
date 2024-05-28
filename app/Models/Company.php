<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasLiabilities;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasLiabilities;
}
