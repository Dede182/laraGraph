<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->hire_date = now();
        });
    }

    protected $fillable = ["first_name","last_name","email","phone","user_id",'hire_date','department'];

    protected $casts = [
        'hire_date' => 'datetime',
    ];


    public function getHireDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
