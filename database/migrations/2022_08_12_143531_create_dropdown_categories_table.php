<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropdown_categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('dropdown_categories')->insert([
            'category' => 'Department',
        ]);

        DB::table('dropdown_categories')->insert([
            'category' => 'Position',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dropdown_categories');
    }
};
