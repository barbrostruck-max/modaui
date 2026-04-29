<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('logo_collapsed')->default('modaui-logo-Collapsed.png');
            $table->string('logo_collapsed_path')->default('assets/img/logo/modaui-logo-Collapsed.png');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['logo_collapsed', 'logo_collapsed_path']);
        });
    }
};
