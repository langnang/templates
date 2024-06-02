<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Module;

class CreateFieldsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fields', function (Blueprint $table) {
      $table->id('cid');
      $table->string('name')->nullable()->comment("字段名称");
      $table->string('type')->nullable()->comment("字段类型");
      $table->string('str_value')->nullable()->comment("");
      $table->string('int_value')->nullable()->comment("");
      $table->string('float_value')->nullable()->comment("");
      $table->string('text_value')->nullable()->comment("");
      $table->string('object_value')->nullable()->comment("");

      $table->timestamps();
      $table->timestamp('release_at')->nullable()->comment('发布时间');
      $table->timestamp('deleted_at')->nullable()->comment('删除时间');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('fields');
  }
}
