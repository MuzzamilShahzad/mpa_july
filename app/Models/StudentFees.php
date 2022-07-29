<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class StudentFees extends Model
{
    use HasFactory;
    protected $table = "student_feeses";

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
