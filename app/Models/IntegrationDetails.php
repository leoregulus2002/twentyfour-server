<?php

namespace App\Models;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationDetails extends Model
{
    use HasFactory;
    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }
}
