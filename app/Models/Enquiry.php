<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'company_name', 'key_person', 'email', 'country', 'phone', 'industry', 'enquiry', 'enquiry_status', 'order_status'
    ];
}
