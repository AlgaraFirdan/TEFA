<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $fillable = ['nama', 'kode', 'penanggung_jawab_id'];

    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'penanggung_jawab_id');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}