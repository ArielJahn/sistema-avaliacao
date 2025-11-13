<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perguntas', function (Blueprint $table) {
            $table->foreignId('setor_id')
                ->after('id') // Posiciona a coluna depois do ID
                ->constrained('setores') // Cria a chave estrangeira para 'setores'
                ->cascadeOnDelete(); // Se um setor for deletado, apaga as perguntas dele
        });
    }

    public function down(): void
    {
        Schema::table('perguntas', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['setor_id']);
            $table->dropColumn('setor_id');
        });
    }
};