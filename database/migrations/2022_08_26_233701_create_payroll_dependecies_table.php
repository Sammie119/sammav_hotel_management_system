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
        Schema::create('payroll_dependecies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('staff_id');
            $table->json('income')->comment('basic, allowance, ect');
            $table->json('deduction')->comment('Tax, Loans, ssnit, ect');
            $table->json('loans')->nullable();
            $table->json('repay_loan')->nullable();
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
        Schema::dropIfExists('payroll_dependecies');
    }
};
