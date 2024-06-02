<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Module;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id('lid');
            $table->string('slug')->nullable()->unique()->comment('标识');
            $table->string('title')->nullable()->comment('标题');
            $table->string('ico')->nullable()->comment('标徽');
            $table->string('url')->nullable()->comment('地址');
            $table->string('description')->nullable()->comment('描述');
            $table->string('type')->nullable()->comment('类型');
            $table->string('status')->nullable()->comment('状态');
            $table->string('count')->nullable()->default(0)->comment('计数');
            $table->string('order')->nullable()->default(0)->comment('权重');
            $table->string('parent')->nullable()->default(0)->comment('父本');

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
        Schema::dropIfExists('links');
    }
}