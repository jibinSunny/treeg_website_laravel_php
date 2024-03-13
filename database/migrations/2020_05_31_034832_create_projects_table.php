<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('location');
            $table->integer('type');
            $table->enum('status',[1,2,3]);
            $table->boolean('show_booking_status_tab')->default(0);
            $table->boolean('active')->default(true);
            $table->integer('priority')->nullable();
            $table->string('phone','13')->nullable();
            $table->text('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('caption')->nullable();
            $table->string('slug')->nullable();
            $table->string('brochure')->nullable();
            $table->string('booking_image')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
