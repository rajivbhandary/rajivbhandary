<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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
        User::create([
            "image" => "users/1.jpg",
            "name" => "Perks Property Admin",
            'email' => self::SUPER_ADMIN_EMAIL,
            "phone_number" => "9876543000",
            'password' => Hash::make("abcd1234"),
        ]);
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