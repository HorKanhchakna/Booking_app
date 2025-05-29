<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
