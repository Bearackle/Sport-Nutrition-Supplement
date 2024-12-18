<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Address
 * @mixin Builder
 */
class Address extends Model
{
    use HasFactory;
    protected $primaryKey = 'address_id';
    protected $fillable = ['user_id','address_detail'];
    protected $table = 'addresses';
    public $timestamps = false;
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','user_ids');
    }
}
