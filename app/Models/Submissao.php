<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submissao extends Model
{
    use HasFactory;

    protected $table = 'submissoes';

    protected $fillable = ['dispositivo_id', 'feedback_textual'];

    public function dispositivo(): BelongsTo
    {
        return $this->belongsTo(Dispositivo::class);
    }

    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }
}
