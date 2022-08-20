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
        Schema::create('dropdowns', function (Blueprint $table) {
            $table->id('dropdown_id');
            $table->unsignedInteger('category_id');
            $table->string('dropdown_name');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('dropdowns')->insert([
            'category_id' => 1,
            'dropdown_name' => 'Administration',
        ]);

        DB::table('dropdowns')->insert([
            'category_id' => 2,
            'dropdown_name' => 'System Admin',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dropdowns');
    }
};
