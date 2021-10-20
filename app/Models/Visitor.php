<?php

namespace App\Models;

use Database\Factories\VisitorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable=['name','phone','email','company','qr_code','is_login','have_food','food_time'
        ,'login_time','is_send','occasion_id'];




    public static function test_models_can_be_instantiated()
    {
        Visitor::factory()->count(100)->create();
        // Use model in tests...

    }
    public function cccasion ()
    {
        return $this->belongsTo(Occasion::class,'occasion_id');
    }
    protected $casts = ['login_time' => 'datetime','food_time' => 'datetime'];
}
