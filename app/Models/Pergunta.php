<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'setor_id',
        'texto_pergunta',
        'status',
        'ordem'
    ];

    /**
     * Uma Pergunta pertence a um Setor.
     */
    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }

    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }
}