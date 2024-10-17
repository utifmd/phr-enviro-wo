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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->nullable();
            $table->string('description')->nullable();
            $table->integer('req_qty')->nullable();
            $table->integer('rem_qty')->nullable();
            $table->integer('sch_qty')->nullable();
            $table->string('uom')->nullable();
            $table->dateTime('required_date')->nullable();
            $table->string( 'pick_up_from')->nullable();
            $table->string('destination')->nullable();
            $table->string('wr_number')->nullable();
            $table->string('rig_name')->nullable();
            $table->string('pic')->nullable();
            $table->string('change')->nullable();
            $table->timestamps();
            $table->foreignUuid('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
