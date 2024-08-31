<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_reg';
    protected $table = 'regions';

    public function customers(){
        return $this->hasMany(Customers::class);
    }
}
