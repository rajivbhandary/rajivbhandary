<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Contact details shown in the header, footer, contact page and the
 * call / WhatsApp buttons. Edited from Control Panel > Site Settings.
 */
class AddContactDetailsToConfigsTable extends Migration
{
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('contact_phone', 20)->nullable();
            $table->string('contact_whatsapp', 20)->nullable();
            $table->string('contact_email')->nullable();
        });
    }

    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropColumn(['contact_phone', 'contact_whatsapp', 'contact_email']);
        });
    }
}
