<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class ClientGroup extends Model
{
    use HasFactory;

    public function getClientGroupListAttribute(): Collection
    {
        return collect(explode(',', $this->client_group))
                    ->when(isset($this->other_types), function ($collection) {
                        return $collection
                                    ->reject(fn ($value, $key) => $value === "Other")
                                    ->merge(explode(',', $this->other_types));
                    });
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
