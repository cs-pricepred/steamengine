<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skin extends Model
{
    use HasFactory;
    use HasUuids;

    public function weapon(): BelongsTo {
        return $this->belongsTo(Weapon::class);
    }

    public function historicSales(): HasMany {
        return $this->hasMany(HistoricSale::class, 'item_id');
    }

}
