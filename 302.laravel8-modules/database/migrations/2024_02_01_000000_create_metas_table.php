<?php

use App\Support\Helpers\ModuleHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;
use App\Support\Module;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 基本标记表
        Schema::create('metas', function (Blueprint $table) {
            $table->id('mid');

            $table->string('slug')->nullable()->unique()->comment('标识');
            $table->string('name')->nullable()->comment('标题');
            $table->string('ico')->nullable()->comment('标徽');
            $table->string('description')->nullable()->comment('描述');
            $table->string('type')->nullable()->comment('类型');
            $table->string('status')->nullable()->comment('状态');
            $table->integer('count')->nullable()->default(0)->comment('计数');
            $table->integer('order')->nullable()->default(0)->comment('权重');
            $table->integer('parent')->nullable()->default(0)->comment('父本');

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
        Schema::dropIfExists('metas');
    }
}
