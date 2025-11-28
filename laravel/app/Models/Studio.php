<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
#use Carbon\Carbon;

class Studio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'location',
        'short_description', 
        'description',
        'image',
        'founded_at',
    ];

    protected $casts = [
        'founded_at' => 'date', 
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }

    #protected function foundedAt(): Attribute
    #{   
    #return Attribute::make(
    #    set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
    #    get: fn ($value) => Carbon::parse($value),
    #);
    #}
}