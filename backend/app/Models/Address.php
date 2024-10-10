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
    protected $primaryKey = 'AddressID';
    protected $fillable = ['UserID','AddressDetail'];
    protected $table = 'Address';
    public function user(){
        return $this->belongsTo('User','UserID');
    }
}
