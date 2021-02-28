<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('from');
                $table->date('to');
                $table->text('description');
                $table->unsignedBigInteger('type_id')->default(1);
                $table->unsignedBigInteger('status_id')->default(3);
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('type_id')->references('id')->on('leave_type')
                ->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('status_id')->references('id')->on('leave_status')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
