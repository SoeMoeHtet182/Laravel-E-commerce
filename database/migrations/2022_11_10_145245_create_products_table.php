<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class);
            $table->foreignIdFor(Supplier::class);
            $table->integer('buying_price');
            $table->text('slug')->unique();
            $table->string('name');
            $table->text('image');
            $table->integer('sale_price');
            $table->integer('discount_price')->default(0);
            $table->integer('total_quantity');
            $table->longText('description');
            $table->integer('view_count');
            $table->integer('like_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
