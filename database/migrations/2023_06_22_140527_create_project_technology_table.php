<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_technology', function (Blueprint $table) {
            // Relazione tabella projects
            //Creo la colonna
            $table->unsignedBigInteger('project_id');
            //Creo la FK
            $table->foreign('project_id')
                    ->reference('id')
                    ->on('projects')
                    ->cascadeOnDelete(); //All'eliminazione di un progetto, viene anche eliminata la relazione con le technologies

            // Relazione tabella technologies
            //Creo la colonna
            $table->unsignedBigInteger('technology_id');
            //Creo la FK
            $table->foreign('technology_id')
                    ->reference('id')
                    ->on('technologies')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
    }
};
