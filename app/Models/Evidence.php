<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Evidence extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function reference() :Attribute
    {
        return Attribute::set(fn($value) => Str::upper(Str::replace(" ","_",$value)));
    }

    public function createdAt() :Attribute
    {
        return Attribute::get(fn($value) => date("Y-m-d", strtotime($value)));
    }
}