<?php

use App\Config\Blueprint;
use App\Config\Schema;

return new class {

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
