<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('帖子标题');
            $table->text('body')->nullable()->comment('帖子内容');
            $table->integer('user_id')->index()->unsigned()->comment('用户id');
            $table->integer('category_id')->index()->unsigned()->comment('分类id');
            $table->integer('reply_count')->unsigned()->default(0)->index()->comment('回复数量');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('查看数量');
            $table->integer('last_reply_user_id')->unsigned()->default(0)->index()->comment('最后回复人id');
            $table->integer('order')->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('文章摘要');
            $table->string('slug')->nullable()->comment('友好url');

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
        Schema::dropIfExists('topics');
    }
}
