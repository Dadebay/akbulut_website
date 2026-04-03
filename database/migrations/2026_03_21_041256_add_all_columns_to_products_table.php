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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->string('name_tk')->nullable()->after('category_id');
            $table->string('name_ru')->nullable()->after('name_tk');
            $table->string('name_en')->nullable()->after('name_ru');
            $table->text('general_info_tk')->nullable()->after('name_en');
            $table->text('general_info_ru')->nullable()->after('general_info_tk');
            $table->text('general_info_en')->nullable()->after('general_info_ru');
            $table->text('description_tk')->nullable()->after('general_info_en');
            $table->text('description_ru')->nullable()->after('description_tk');
            $table->text('description_en')->nullable()->after('description_ru');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id','name_tk','name_ru','name_en',
                'general_info_tk','general_info_ru','general_info_en',
                'description_tk','description_ru','description_en',
            ]);
        });
    }
};
