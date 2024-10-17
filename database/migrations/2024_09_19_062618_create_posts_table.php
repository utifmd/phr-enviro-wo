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
        Schema::create('posts', function (Blueprint $table) {
            $postTypes = collect(\App\Utils\PostTypeEnum::cases())
                ->map(function ($item){ return $item->value; })
                ->toArray();

            $table->uuid('id')->primary()->unique();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->enum('type', $postTypes);

            $table->foreignUuid('user_id')
                ->nullable()
                ->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
