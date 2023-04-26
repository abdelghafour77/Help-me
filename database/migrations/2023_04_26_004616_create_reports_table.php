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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->morphs('reportable'); // polymorphic relationship to the reported model
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user who reported the content
            $table->foreignId('report_type_id')->constrained()->onDelete('cascade'); // type of report
            $table->text('description')->nullable(); // description of the report
            $table->boolean('is_resolved')->default(false); // whether the report has been resolved
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('cascade'); // user who resolved the report
            $table->text('resolution')->nullable(); // resolution of the report
            $table->timestamp('resolved_at')->nullable(); // when the report was resolved
            $table->timestamp('reported_at')->nullable(); // when the report was reported
            $table->foreignId('question_id')->nullable()->constrained()->onDelete('cascade'); // question that was reported
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
