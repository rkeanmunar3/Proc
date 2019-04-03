<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('category_id');
            $table->string('type');
            $table->timestamp('deadline');
            $table->integer('delivery_type');
            $table->string('sender_name');
            $table->integer('sender_address');
            $table->integer('recipient');
            $table->text('details');

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
        Schema::dropIfExists('document_transactions');
    }
}
