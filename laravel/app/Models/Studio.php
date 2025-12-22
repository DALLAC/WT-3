<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Auth\Access\AuthorizationException;
#use Carbon\Carbon;

class Studio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'location',
        'user_id',
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
    protected static function booted(): void
    {
        static::creating(function (Studio $studio) {
            // Не мешаем консоли/сидерам
            if (app()->runningInConsole()) {
                return;
            }

            if (!auth()->check()) {
                throw new AuthorizationException('Неавторизованный доступ');
            }

            // Если из формы не пришёл user_id — ставим текущего пользователя
            if (!$studio->user_id) {
                $studio->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}