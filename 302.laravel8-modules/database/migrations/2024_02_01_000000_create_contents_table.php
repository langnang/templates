<?php


use App\Support\Module;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 基本内容表
        Schema::create('contents', function (Blueprint $table) {
            $table->id('cid')->comment("编号");
            $table->string('slug')->nullable()->unique()->comment('标识');
            $table->string('title')->nullable()->comment('标题');
            $table->string('ico')->nullable()->comment('标徽');
            $table->string('description')->nullable()->comment('描述');
            $table->string('type')->nullable()->comment('类型');
            $table->string('status')->nullable()->comment('状态');
            $table->longText('text')->default("<!-- markdown -->")->nullable()->comment('内容');

            $table->string('template')->default(0)->nullable()->comment('模板');
            $table->string('views')->default(0)->nullable()->comment('视图');
            $table->string('count')->default(0)->nullable()->comment('计数');
            $table->string('order')->default(0)->nullable()->comment('权重');
            $table->string('parent')->default(0)->nullable()->comment('父本');

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
        Schema::dropIfExists('contents');
    }
}
