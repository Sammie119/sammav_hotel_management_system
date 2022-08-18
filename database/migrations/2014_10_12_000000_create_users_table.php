<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->unsignedTinyInteger('role')->default(0)->comment('0 = User, 1 = Admin, 2 = Super Admin');
            $table->unsignedTinyInteger('department', 100)->nullable();
            $table->string('p_contact', 15)->nullable();
            $table->string('o_contact', 15)->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
