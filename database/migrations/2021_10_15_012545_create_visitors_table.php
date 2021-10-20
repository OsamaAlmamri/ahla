<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occasion_id')
                ->constrained('occasions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('name', 191);
            $table->string('phone', 15)->nullable();
            $table->string('email', 191)->nullable();
            $table->string("company")->nullable();


            $table->string("qr_code")->unique();

            $table->boolean("have_food")->default(0);
            $table->boolean("is_login")->default(0);
            $table->dateTime("food_time")->nullable();
            $table->dateTime("login_time")->nullable();
            $table->boolean("is_send")->default(0);
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
        Schema::dropIfExists('visitors');
    }
}
