<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->dropColumn('published');
            $table->renameColumn('publishedDATA', 'published_at');
            $table->boolean('is_published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ($table) {
            $table->binarr('published');
            $table->renameColumn('published_at', 'publishedDATA');
            $table->boolean('is_published');
        });
    }
}
