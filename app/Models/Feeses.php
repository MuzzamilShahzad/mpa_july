<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentFees;

class Feeses extends Model
{
    use HasFactory;

    public function feeTypes()
    {
        return $this->belongsTo(FeesTypes::class, "fees_type_id", "id");
    }

    public function studentFees()
    {
        return $this->hasOne(StudentFees::class, "fees_id", "id");
    }
}
