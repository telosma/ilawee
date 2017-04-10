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
            $table->integer('item_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->integer('file_id')->unsigned();
            $table->string('limit');
            $table->string('notation');
            $table->string('fields')->nullable()->default(null);
            $table->date('puclic_date')->nullable()->default(null);
            $table->date('start_date');
            $table->string('effective', 200);
            $table->string('signer');
            $table->string('description');
            $table->string('source');
            $table->string('more_info');
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
