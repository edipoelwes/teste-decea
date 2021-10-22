<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchase_products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('company_id');
      $table->unsignedBigInteger('purchase_id');
      $table->unsignedBigInteger('product_id');

      $table->integer('amount');
      $table->decimal('sub_total', $precision = 8, $scale = 2)->default(0);

      $table->timestamps();
      $table->softDeletes($column = 'deleted_at', $precision = 0);

      $table->foreign('company_id')->references('id')->on('companies');
      $table->foreign('purchase_id')->references('id')->on('purchases');
      $table->foreign('product_id')->references('id')->on('products');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('purchase_products');
  }
}
