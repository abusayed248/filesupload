<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_magic_links_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagicLinksTable extends Migration
{
    public function up()
    {
        Schema::create('magic_links', function (Blueprint $table) {
            $table->id();  // Primary key, auto-incrementing
            $table->string('email');  // Email address of the user requesting the magic link
            $table->string('token')->unique();  // Unique token for the magic link
            $table->timestamp('expires_at');  // Expiration time for the token
            $table->timestamps();  // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('magic_links');  // Drop the table if the migration is rolled back
    }
}

