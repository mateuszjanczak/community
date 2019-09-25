<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginTagsToTagsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags_posts', function (Blueprint $table) {
            $table->foreign('tagId', 'tags_posts_tag_id_foreign')->references('id')->on('tags');
            $table->foreign('postId', 'tags_posts_post_id_foreign')->references('id')->on('posts')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags_posts', function (Blueprint $table) {
            $table->dropForeign('tags_posts_tag_id_foreign');
            $table->dropForeign('tags_posts_post_id_foreign');
        });
    }
}
