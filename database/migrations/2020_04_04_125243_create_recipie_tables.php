<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipieTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipie_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('sort')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('recipies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('public_flag')->default(false);
            $table->text('notes')->nullable();
            $table->integer('prep_time')->nullable();
            $table->integer('cook_time')->nullable();
            $table->integer('oven_temp')->nullable();
            $table->integer('yield')->nullable();
            $table->string('yield_unit')->nullable();
            $table->text('origin')->nullable()->default(null);
            $table->text('photo')->nullable()->default(null);
            $table->unsignedBigInteger('author_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('recipie_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id');
            $table->unsignedBigInteger('item_id');
            $table->string('unit')->nullable();
            $table->decimal('amount', 6, 2)->default(1);
            $table->boolean('optional')->default(false);
            $table->text('notes')->nullable();
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();

            $table->foreign('recipie_id')->references('id')->on('recipies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('recipie_directions', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id');
            $table->string('heading')->nullable();
            $table->text('details')->nullable();
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();

            $table->foreign('recipie_id')->references('id')->on('recipies')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('recipie_category', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('recipie_id');
            $table->timestamps();

            $table->foreign('recipie_id')->references('id')->on('recipies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('recipie_categories')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('recipie_ratings', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('rating');
            $table->timestamps();

            $table->foreign('recipie_id')->references('id')->on('recipies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('recipie_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->unique(['recipie_id', 'tag_id']);
            $table->foreign('recipie_id')->references('id')->on('recipies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipie_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('recipie_ratings');
        Schema::dropIfExists('recipie_directions');
        Schema::dropIfExists('recipie_ingredients');
        Schema::dropIfExists('recipies');
    }
}
