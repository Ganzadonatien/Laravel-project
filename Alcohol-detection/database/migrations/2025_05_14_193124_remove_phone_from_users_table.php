<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Drop the phone column
        $table->dropColumn('phone');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Re-add the phone column if rolling back the migration
        $table->string('phone')->nullable();
    });
}
};
