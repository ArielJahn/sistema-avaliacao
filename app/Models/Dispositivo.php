<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'setor_id', 'status'];

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }

    public function submissoes(): HasMany
    {
        return $this->hasMany(Submissao::class);
    }
}
