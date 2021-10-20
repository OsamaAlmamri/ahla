<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        // 'title','notification','file','admin_id'
        'id', 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
