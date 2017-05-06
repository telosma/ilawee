<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable()->default(null);
            $table->integer('doc_type_id')->unsigned();
            $table->string('limit');
            $table->string('notation');
            $table->string('fields')->nullable()->default(null);
            $table->date('publish_date')->nullable()->default(null);
            $table->date('start_date')->nullable()->default(null);
            $table->string('effective', 200);
            $table->text('description');
            $table->string('source');
            $table->longtext('content');
            $table->boolean('confirmed')->default(false);
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
        Schema::drop('documents');
    }
}
