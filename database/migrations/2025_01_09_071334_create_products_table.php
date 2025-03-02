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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('slug')->unique();
            $table->foreignId('series_id')->nullable()->constrained('series')->onDelete('set null'); // Allow NULL
            $table->foreignId('brand_id')->constrained('brands'); // Not nullable
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->check('price >= 0');
            $table->integer('stock_quantity')->check('stock_quantity >= 0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
