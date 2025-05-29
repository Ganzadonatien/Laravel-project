<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing devices without status to 'available'
        DB::table('devices')
            ->whereNull('status')
            ->orWhere('status', '')
            ->update(['status' => 'available']);

        // Update devices that are assigned to users
        DB::table('devices')
            ->whereIn('id', function($query) {
                $query->select('device_id')
                      ->from('users')
                      ->whereNotNull('device_id');
            })
            ->update(['status' => 'assigned']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this data migration
    }
};
