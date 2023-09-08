<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model {
    use HasFactory;
    use HasUuids;

    protected $fillable = ['name'];

    public function historicSales(): HasMany {
        return $this->hasMany(HistoricSale::class, 'item_id');
    }
}
