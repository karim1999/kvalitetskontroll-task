<?php

namespace App\Models;

use App\Constants\OrderStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [ 'user_id', 'status', 'customer_name' ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => OrderStatuses::class,
    ];

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
