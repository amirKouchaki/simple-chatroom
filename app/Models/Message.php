<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['text'];


    public function createdAt() : Attribute {
        return  Attribute::make(
            get: fn($date) => Carbon::parse($date)->format('Y-m-d H:i')
        );
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
