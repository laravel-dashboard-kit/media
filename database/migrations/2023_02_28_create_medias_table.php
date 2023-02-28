<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->uuid('id');
            $table->morphs('mediable');
            $table->string('file_name');
            $table->string('disk')->default('public');
            $table->string('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
