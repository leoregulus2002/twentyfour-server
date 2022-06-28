<?php

namespace App\Models;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','amount'];
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }
    /**
     * 所属用户
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    /**
     * 积分细节
     */
    public function integrationDetails()
    {
        return $this->hasMany(IntegrationDetails::class,'user_id','user_id');
    }
}
