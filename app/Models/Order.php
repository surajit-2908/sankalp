<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'invoice_number', 'company_name', 'order_confirmed', 'production', 'packaging', 'delivery'
    ];

    public function getComapanyName()
    {
        return $this->hasOne(CompanyName::class, 'id', 'company_name');
    }
}
