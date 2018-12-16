<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'posts';

    /**
     * Run the migrations.
     * @table posts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('postsID');
            $table->string('title', 45)->nullable();
            $table->binary('published')->nullable();
            $table->mediumText('content')->nullable();
            $table->integer('authors_authorID');
            $table->integer('category_categoryID');
            $table->binary('image')->nullable();
            $table->dateTime('publishedDATA')->nullable();
            $table->string('description', 45)->nullable();
            $table->string('postURL', 45)->nullable();

            $table->index(["authors_authorID"], 'fk_posts_authors_idx');

            $table->index(["category_categoryID"], 'fk_posts_category1_idx');


            $table->foreign('authors_authorID', 'fk_posts_authors_idx')
                ->references('authorID')->on('authors')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('category_categoryID', 'fk_posts_category1_idx')
                ->references('categoryID')->on('category')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}