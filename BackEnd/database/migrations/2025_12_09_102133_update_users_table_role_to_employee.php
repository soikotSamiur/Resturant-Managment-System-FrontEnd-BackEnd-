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
        // Update existing 'User' role to 'Employee'
        DB::table('users')
            ->where('role', 'User')
            ->update(['role' => 'Employee']);
        
        // Alter the column to use new enum values
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Admin', 'Employee', 'Waiter', 'Chef', 'Cashier') DEFAULT 'Employee'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert Employee back to User
        DB::table('users')
            ->where('role', 'Employee')
            ->update(['role' => 'User']);
        
        // Revert the column enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Admin', 'User', 'Waiter', 'Chef', 'Cashier') DEFAULT 'User'");
    }
};
