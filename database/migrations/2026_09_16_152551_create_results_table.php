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
    Schema::create('results', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')
            ->constrained('students')
            ->cascadeOnDelete();

        $table->foreignId('subject_id')
            ->constrained('subjects')
            ->cascadeOnDelete();

        $table->string('exam_name');

        $table->decimal('marks', 5, 2);

        $table->string('grade')->nullable();

        $table->decimal('gpa', 3, 2)->nullable();

        $table->text('remarks')->nullable();

        $table->timestamps();

        $table->unique([
            'student_id',
            'subject_id',
            'exam_name'
        ]);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
