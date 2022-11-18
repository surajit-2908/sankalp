<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id','log'
    ];

    public function getUser()
    {
        return $this->hasOne(Admin::class, 'id', 'user_id');
    }
}
