<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CampusDetails;

class Campus extends Model
{
    use HasFactory;

    public function campusDetails()
    {
        return $this->hasOne(CampusDetails::class);
    }
}
