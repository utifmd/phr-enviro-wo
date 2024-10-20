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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
            $table->string('description')->nullable(false)->change();
            $table->integer('req_qty')->nullable(false)->change();
            $table->integer('rem_qty')->nullable(false)->change();
            $table->integer('sch_qty')->nullable(false)->change();
            $table->string('uom')->nullable(false)->change();
            $table->dateTime('required_date')->nullable(false)->change();
            $table->string( 'pick_up_from')->nullable(false)->change();
            $table->string('destination')->nullable(false)->change();
            $table->string('wr_number')->nullable(false)->change();
            $table->string('rig_name')->nullable(false)->change();
            $table->string('pic')->nullable(false)->change();
            $table->string('change')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->integer('req_qty')->nullable()->change();
            $table->integer('rem_qty')->nullable()->change();
            $table->integer('sch_qty')->nullable()->change();
            $table->string('uom')->nullable()->change();
            $table->dateTime('required_date')->nullable()->change();
            $table->string( 'pick_up_from')->nullable()->change();
            $table->string('destination')->nullable()->change();
            $table->string('wr_number')->nullable()->change();
            $table->string('rig_name')->nullable()->change();
            $table->string('pic')->nullable()->change();
            $table->string('change')->nullable()->change();
        });
    }
};
