<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    use HasFactory;

//   $table->string("name");
//            $table->date("date");
//            $table->integer("visitors");
    protected $fillable = ['name', 'date', 'visitors'];

    protected $casts = ['date' => 'date'];


    public function all_visitors()
    {
        return $this->hasMany(Visitor::class, 'occasion_id','id');
    }
}
