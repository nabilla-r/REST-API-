<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drink extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'drink';

    protected $fillable = ['name_drink', 'flavor', 'amount', 'type_drink', 'author'];

    public function write_orders(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
