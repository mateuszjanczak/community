<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPostsToLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('postId', 'likes_post_id_foreign')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('commentId', 'likes_comment_id_foreign')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('userId', 'likes_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('likes_post_id_foreign');
            $table->dropForeign('likes_comment_id_foreign');
            $table->dropForeign('likes_user_id_foreign');
        });
    }
}
