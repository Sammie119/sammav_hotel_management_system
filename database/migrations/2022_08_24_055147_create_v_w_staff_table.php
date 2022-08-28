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
        DB::unprepared("CREATE OR REPLACE VIEW v_w_staff as
            SELECT 
                s.staff_id, 
                ss.salary_id,
                firstname, 
                othernames,
                CONCAT(firstname, \" \", othernames) AS fullname,
                date_of_birth, 
                DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),date_of_birth)), '%Y')+0 AS age, 
                phone, 
                address, 
                level_of_education, 
                qualification, 
                relative_name, 
                relative_contact,
                salary_type_id,
                d.dropdown_name AS salary_type,
                department_id,
                dd.dropdown_name AS department,
                position_id,
                ddd.dropdown_name AS position,
                salary,
                ss.created_by,
                u.name AS created_by_name,
                ss.updated_by,
                uu.name AS updated_by_name,
                s.created_at, 
                s.updated_at 
            FROM staff s, setup_salaries ss, dropdowns d, dropdowns dd, dropdowns ddd, users u, users uu
            WHERE s.staff_id = ss.staff_id
            AND d.dropdown_id = ss.salary_type_id
            AND dd.dropdown_id = ss.department_id
            AND ddd.dropdown_id = ss.position_id
            AND u.user_id = ss.created_by
            AND uu.user_id = ss.updated_by
            AND s.deleted_at is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_w_staff');
    }
};
