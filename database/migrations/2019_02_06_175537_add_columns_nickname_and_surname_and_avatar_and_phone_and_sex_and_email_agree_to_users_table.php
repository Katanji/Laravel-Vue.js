<?php
declare(strict_types = 1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsNicknameAndSurnameAndAvatarAndPhoneAndSexAndEmailAgreeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->after('id');
            $table->string('surname')->after('name');
            $table->string('avatar')->default('default.jpg');
            $table->string('phone',10);
            $table->enum('sex', ['male', 'female']);
            $table->boolean('newsletter_agree');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
