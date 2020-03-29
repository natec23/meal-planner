<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('default_list')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('color')->default('#c0c0c0');
            $table->boolean('is_food')->default(true);
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->default(1);
            $table->string('name');
            $table->string('emoji')->nullable()->default(NULL);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('grocery_list_item', function (Blueprint $table) {
            $table->unsignedBigInteger('grocery_list_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('qty')->default(1);
            $table->string('unit')->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);
            // $table->unsignedBigInteger('added_by');
            // $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            // $table->dateTime('completed_at')->nullable()->default(NULL);
            $table->timestamps();

            $table->primary(['grocery_list_id', 'item_id']);
            $table->foreign('grocery_list_id')->references('id')->on('grocery_lists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
        });

        $this->_defaults();
    }

    private function _defaults()
    {
        DB::table('grocery_lists')->insert([
            'name' => 'Grocery List',
            'default_list' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Uncategorized',
            'created_at' => now(),
            'updated_at' => now(),
            'sort' => 4
        ]);

        DB::table('categories')->insert([
            'name' => 'Fruits & Vegtables',
            'created_at' => now(),
            'updated_at' => now(),
            'sort' => 1,
            'color' => '#74d600'
        ]);

        DB::table('categories')->insert([
            'name' => 'Bread & Pastries',
            'created_at' => now(),
            'updated_at' => now(),
            'sort' => 2,
            'color' => '#9B806C'
        ]);

        DB::table('categories')->insert([
            'name' => 'Non-Food Items',
            'created_at' => now(),
            'updated_at' => now(),
            'is_food' => false,
            'sort' => 3
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lists');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_list');
    }
}
