<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox', function (Blueprint $table) {
            $table->id();
            $table->string('sender_email');
            $table->string('sender_name')->nullable();
            $table->text('subject');
            $table->text('body');
            $table->text('html');
            $table->bigInteger('number');
            $table->bigInteger('uid');
            $table->timestampTz('received_at')->index();

            $table->index(['sender_email', 'sender_name']);
            $table->rawIndex('subject(100)', 'inbox_subject_idx');
            $table->rawIndex('body(100)', 'inbox_body_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox');
    }
}
