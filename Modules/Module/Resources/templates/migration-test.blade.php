<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration

    public function up() {
        Schema::create('', function (Blueprint $table) {
            $table->uuid('id')->primary();
    
            $table->timestamps();
        }
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
};
