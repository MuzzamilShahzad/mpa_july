<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use App\Models\Campus;
use App\Models\System;

class Registration extends Model
{
    use HasFactory;
    protected $table = "student_registrations";

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function campusDetails()
    {
        return $this->belongsTo(campusDetails::class, 'campus_id', 'id');
    }
}
