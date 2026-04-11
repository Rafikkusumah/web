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
        Schema::create('invoice2', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('salesperson');
            $table->string('company_name');
            $table->text('address');
            $table->string('city');
            $table->string('zip_code');
            $table->text('project_description');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->boolean('use_vat')->default(false);
            $table->decimal('vat_percentage', 5, 2)->default(11.00);
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice2');
    }
};
