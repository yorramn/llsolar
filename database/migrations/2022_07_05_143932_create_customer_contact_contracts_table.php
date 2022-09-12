<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contact_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('old_titular_cpf')->nullable();
            $table->integer('old_contact_contract')->nullable();
            $table->string('cpf');
            $table->string('contact_contract');
            $table->integer('kwh');
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('customer_contact_contracts');
    }
};
