<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class HistoricSale extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['time', 'price', 'volume', 'item_id'];

    public function skin(): BelongsTo {
        return $this->belongsTo(Skin::class);
    }

    public function time(): Attribute {
        return Attribute::make(
            get: fn(string $value) => Carbon::createFromTimestampUTC($value)->toDateString(),
        );
    }
}
