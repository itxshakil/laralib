<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author');
            $table->string('isbn', 13)->nullable();
            $table->string('publisher')->nullable();
            $table->year('year')->nullable();
            $table->text('message')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('user_id')->nullable();
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
        Schema::dropIfExists('requested_books');
    }
}
