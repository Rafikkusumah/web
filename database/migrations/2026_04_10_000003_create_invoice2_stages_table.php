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
        Schema::create('invoice2_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice2_id')->constrained('invoice2')->onDelete('cascade');
            $table->string('stage_name'); // e.g. "Down Payment", "After Installation"
            $table->decimal('stage_percentage', 5, 2); // e.g. 50.00 for 50%
            $table->decimal('stage_amount', 15, 2); // calculated amount
            $table->date('stage_due_date');
            $table->enum('stage_status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->text('stage_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice2_stages');
    }
};
