<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('company_id');
      $table->unsignedBigInteger('user_id');

      $table->string('status')->nullable();
      $table->string('payment_method')->nullable();
      $table->text('obs')->nullable();
      $table->string('provider')->nullable();
      $table->date('due_date')->nullable();
      $table->decimal('total', $precision = 8, $scale = 2)->default(0);

      $table->timestamps();
      $table->softDeletes($column = 'deleted_at', $precision = 0);

      $table->foreign('company_id')->references('id')->on('companies');
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('purchases');
  }
}
