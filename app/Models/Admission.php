<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feeses;

class Admission extends Model
{
    use HasFactory;

    public function feeDetails()
    {
        return $this->hasMany(Feeses::class, 'campus_id', 'campus_id');
    }

    public function classes()
    {
        return $this->belongsTo(classes::class, "class_id", "id");
    }

    public function section()
    {
        return $this->belongsTo(section::class);
    }

    public function session()
    {
        return $this->belongsTo(session::class);
    }

    public function campus()
    {
        return $this->belongsTo(campus::class);
    }

}
