<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->integer('user_id');
            $table->text('nickname')->nullable();
            $table->integer('animal_id');
            $table->integer('breed_id');
            $table->integer('color_id');
            $table->integer('gender_id');
            $table->integer('age_id');
            $table->integer('discipline_id');

            $table->string('weight');
            $table->integer('vaccinations');
            $table->integer('horns');
            $table->string('conditions');
            $table->string('number_of_head');
            $table->integer('class_id');
            $table->integer('type_id');
            $table->integer('size_id');
            $table->integer('declawed');
            $table->integer('categorie_id');
            
            $table->integer('temperament');
            $table->string('price');
            $table->text('description');
            $table->integer('city');
            $table->integer('state');
            $table->string('zip');
            $table->integer('country');
            $table->integer('plan_id');
            $table->date('date_init');
            $table->date('date_end');
            $table->integer('homepage');
            $table->string('video')->nullable();
            $table->boolean('disabled')->default(0);
            $table->boolean('sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
