<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(0);
            $table->string('firstname',40)->default('');
            $table->string('lastname',40)->default('');
            $table->string('slug',100)->default('');
            $table->string('organization',80)->default('');
            $table->string('nickname',40)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('country',2)->default('');
            $table->string('profile_pic_url')->default('');
            $table->string('signup_invite_code',80)->default('');
            $table->string('password');
            $table->softDeletes();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
