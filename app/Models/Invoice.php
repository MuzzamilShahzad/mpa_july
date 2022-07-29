<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentFeeses;

class Invoice extends Model
{
    use HasFactory;

    public function studentFeeses()
    {
        return $this->hasMany(StudentFees::class);
    }
}
