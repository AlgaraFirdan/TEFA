<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi';
    protected $fillable = ['nama', 'jam_mulai', 'jam_selesai', 'is_istirahat'];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'is_istirahat' => 'boolean',
    ];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}