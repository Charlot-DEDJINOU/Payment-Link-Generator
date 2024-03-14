<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_firstname');
            $table->string('customer_lastname');
            $table->bigInteger('amount');
            $table->string('description');
            $table->string('plateform');
            $table->string('payment_link');
            $table->string('number')->nullable();
            $table->string('id_generate')->unique();
            $table->string('uuid')->nullable();
            $table->string('currency')->nullable();
            $table->string('country')->nullable();
            $table->string('method')->nullable();
            $table->string('url_callback')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamp('expiration_time')->nullable();
            $table->enum('status', ['PENDING', 'COMPLETED', 'FAILED', 'SUCCESSFUL'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}