<?php

use App\Models\DropdownCategory;
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

        $data = [
            ['category'=> 'Department'],
            ['category'=> 'Position'],
            ['category'=> 'Salary Type'],
            ['category'=> 'Allowances'],
            ['category'=> 'Deductions'],
            ['category'=> 'Loan Type'],
        ];
        
        DropdownCategory::insert($data);
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
