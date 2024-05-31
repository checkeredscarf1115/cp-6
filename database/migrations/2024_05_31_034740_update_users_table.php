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
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');

            $table->string('id_user', length:36)->primary()->default('uuid()');
            $table->bigInteger('phone_number')->unique(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->id();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();

        $table->dropColumn('id_user', length:36)->primary()->default('uuid()');
        $table->dropColumn('phone_number')->unique(true);
    }
};
