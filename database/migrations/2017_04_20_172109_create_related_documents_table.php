<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('document_id');
            $table->integer('guide_doc_id')->nullable()->default(null);
            $table->integer('base_doc_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_documents');
    }
}
