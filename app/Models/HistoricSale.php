<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricSale extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['time', 'price', 'volume', 'skin_id'];

    public function skin(): BelongsTo {
        return $this->belongsTo(Skin::class);
    }
}
