<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country_id")->constrained();
            $table->foreignId("state_id")->constrained();
            $table->foreignId("city_id")->constrained();
            $table->foreignId("department_id")->constrained();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("address");
            $table->char("zip_code");
            $table->date("birth_date");
            $table->date("date_hired");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
