<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('employee_id_number', 20);
            $table->string('citizenship_id_no', 16);
            $table->text('citizenship_id_file');
            $table->date('date_of_birth');
            $table->char('gender', 1);
            $table->string('phone', 16);
            $table->string('position', 50)->nullable();
            $table->string('street', 250)->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('city_name', 250)->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->string('province_name', 250)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('bank_account', 100)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->softDeletesTz('deleted_at')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
