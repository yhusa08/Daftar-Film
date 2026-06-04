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
        Schema::table('films', function (Blueprint $table) {
            if (! Schema::hasColumn('films', 'status')) {
                $table->string('status')->default('Belum Ditonton')->after('durasi');
            }
        });

        Schema::table('series', function (Blueprint $table) {
            if (! Schema::hasColumn('series', 'status')) {
                $table->string('status')->default('Belum Ditonton')->after('jumlah_episode');
            }
        });

        DB::table('films')
            ->whereNotNull('rating')
            ->update(['status' => 'Sudah Ditonton']);

        DB::table('series')
            ->whereNotNull('rating')
            ->update(['status' => 'Sudah Ditonton']);

        Schema::table('films', function (Blueprint $table) {
            if (Schema::hasColumn('films', 'rating')) {
                $table->dropColumn('rating');
            }
        });

        Schema::table('series', function (Blueprint $table) {
            if (Schema::hasColumn('series', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            if (! Schema::hasColumn('films', 'rating')) {
                $table->decimal('rating', 3, 1)->default(0)->after('durasi');
            }
            if (Schema::hasColumn('films', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('series', function (Blueprint $table) {
            if (! Schema::hasColumn('series', 'rating')) {
                $table->decimal('rating', 3, 1)->default(0)->after('jumlah_episode');
            }
            if (Schema::hasColumn('series', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
