<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesDetails extends Model
{
    use HasFactory;


    public function feeTypes()
    {

        return $this->hasMany(FeesTypes::class, "id", "fees_type_id");
    }
}
