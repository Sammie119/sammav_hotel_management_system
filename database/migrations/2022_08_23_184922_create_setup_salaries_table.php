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
        Schema::create('setup_salaries', function (Blueprint $table) {
            $table->id('salary_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedTinyInteger('salary_type_id');
            $table->unsignedTinyInteger('department_id');
            $table->unsignedTinyInteger('position_id');
            $table->decimal('salary', 10, 2);
            $table->string('banker', 100)->nullable();
            $table->string('bank_account', 25)->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('ssnit_number', 100)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
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
        Schema::dropIfExists('setup_salaries');
    }
};
