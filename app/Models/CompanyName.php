<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyName extends Model
{
    protected $table = 'company_names';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'company_name'
    ];
}
