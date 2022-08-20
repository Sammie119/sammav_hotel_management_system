<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->unsignedTinyInteger('role')->default(0)->comment('0 = User, 1 = Admin, 2 = Super Admin');
            $table->unsignedTinyInteger('department')->nullable();
            $table->string('p_contact', 15)->nullable();
            $table->string('o_contact', 15)->nullable();
            $table->unsignedTinyInteger('position')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            'name' => 'Samuel Sarpong-Duah',
            'username' => 'sam119',
            'role' => 3,
            'department' => 1,
            'p_contact' => '0248376160',
            'o_contact' => '000000000',
            'position' => 2,
            'password' =>  Hash::make('sammie119')
        ]);
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
