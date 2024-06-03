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
            $table->integer('cid')->comment("内容编号");
            $table->string('name')->comment("字段名称");
            $table->string('str_value')->nullable()->comment("");
            $table->string('int_value')->nullable()->comment("");
            $table->string('float_value')->nullable()->comment("");
            $table->string('text_value')->nullable()->comment("");
            $table->string('object_value')->nullable()->comment("");

            $table->string('type')->nullable()->comment("字段类型");

            $table->string('template')->default(0)->nullable()->comment('模板');
            $table->string('views')->default(0)->nullable()->comment('视图');
            $table->string('count')->default(0)->nullable()->comment('计数');

            $table->integer("user")->default(0)->comment("用户编号");

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
