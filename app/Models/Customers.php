<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customers';
    protected $primaryKey = 'dni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni',
        'id_reg',
        'id_com',
        'email',
        'name',
        'last_name',
        'address',
        'date_reg',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_reg' => 'integer',
        'id_com' => 'integer',
    ];

    public function scopeDni($query, $dni)
    {
        if (!is_null($dni)) {
            return $query->where('dni', '=', $dni);
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('email', '=', $email);
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if (!is_null($status)) {
            return $query->where('status', '=', $status);
        }
        return $query;
    }

    public function regions(): BelongsTo
    {
        return $this->belongsTo(Regions::class, 'id_reg', 'id_reg');
    }

    public function communes()
    {
        return $this->belongsTo(Communes::class, 'id_com', 'dni');
    }

}
