<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'submissao_id',
        'pergunta_id',
        'pontuacao',
    ];

    public $timestamps = false;

    public function submissao(): BelongsTo
    {
        return $this->belongsTo(Submissao::class);
    }

    public function pergunta(): BelongsTo
    {
        return $this->belongsTo(Pergunta::class);
    }
}