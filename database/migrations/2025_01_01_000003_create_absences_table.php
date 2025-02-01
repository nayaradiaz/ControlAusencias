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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->text('comments')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('time_slot', [
                'mañana_1',
                'mañana_2',
                'mañana_3',
                'recreo_1',
                'mañana_4',
                'mañana_5',
                'mañana_6',
                'tarde_1',
                'tarde_2',
                'tarde_3',
                'recreo_2',
                'tarde_4',
                'tarde_5',
                'tarde_6'

            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
