<?php

use App\Models\Dropdown;
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

        $data = [
            ['category_id'=>1, 'dropdown_name'=> 'Administration'],
            ['category_id'=>2, 'dropdown_name'=> 'System Admin'],
            ['category_id'=>1, 'dropdown_name'=> 'Accommodation'],
            ['category_id'=>1, 'dropdown_name'=> 'Restaurant'],
            ['category_id'=>1, 'dropdown_name'=> 'Bar'],
            ['category_id'=>1, 'dropdown_name'=> 'Conference'],
            ['category_id'=>1, 'dropdown_name'=> 'Kitchen'],
            ['category_id'=>1, 'dropdown_name'=> 'Laundry'],
            ['category_id'=>1, 'dropdown_name'=> 'Accounts'],
            ['category_id'=>3, 'dropdown_name'=> 'Daily'],
            ['category_id'=>3, 'dropdown_name'=> 'Weekly'],
            ['category_id'=>3, 'dropdown_name'=> 'Monthly'],
        ];
        
        Dropdown::insert($data);
        // DB::table('dropdowns')->insert($data);

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
