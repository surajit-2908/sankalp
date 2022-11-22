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
        'id', 'invoice_number', 'company_name_id', 'quantity', 'order_confirmed', 'order_confirmed_items', 'production', 'production_items', 'packaging', 'packaging_items', 'delivery', 'delivery_items', 'order_confirmed_remarks', 'production_remarks', 'packaging_remarks', 'delivery_remarks'
    ];

    public function getComapanyName()
    {
        return $this->hasOne(Company::class, 'id', 'company_name_id');
    }
}
