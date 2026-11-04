<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSuperAdmin extends Migration
{
    private const SUPER_ADMIN_EMAIL = 'connect@perksproperty.in';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // No password is stored in the code. Set SUPER_ADMIN_PASSWORD in .env
        // before migrating, or use "Forgot password" on the login page.
        $password = env('SUPER_ADMIN_PASSWORD') ?: Str::random(40);

        $user = User::create([
            "image" => "users/1.jpg",
            "name" => "Perks Property Admin",
            'email' => self::SUPER_ADMIN_EMAIL,
            "phone_number" => "9876543000",
            'password' => Hash::make($password),
        ]);
        // role is set explicitly: the column defaults to "author".
        $user->role = 'super-admin';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where("email", self::SUPER_ADMIN_EMAIL)->first();
        if ($user) {
            $user->forceDelete();
        }

    }
}