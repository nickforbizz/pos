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
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('fk_tenant')->nullable()->index('employees_tenants_FK');
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->unique('employees_unique');
            $table->string('phone', 100)->nullable();
            $table->text('address')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->integer('active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
