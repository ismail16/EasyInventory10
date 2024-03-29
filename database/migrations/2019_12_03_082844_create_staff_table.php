<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_name');
            $table->string('staff_user_name');
            $table->string('staff_phone')->nullable();
            $table->string('staff_address')->nullable();
            $table->string('user_type');
            $table->string('staff_password');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('staff');
    }
}
