<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained();/*atributo do laravel que permite inserir uma chave estrangeira(foreignkey) e atrelar ela a um usuario de uma tabela */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained()->onDelete("cascade"); /*deleta os registros atrelados ao usuario em modo "cascade" para que todos os registros atrelados a esse usuario sejam deletados e nao fique "nenhum filho sem pai" */
        });
    }
};
