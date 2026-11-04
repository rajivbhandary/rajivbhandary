<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * The enquiry form now asks only for name and mobile number; email,
 * city and state are optional.
 */
class MakeEnquiryContactFieldsOptional extends Migration
{
    public function up()
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        DB::statement('ALTER TABLE enquiries MODIFY email VARCHAR(255) NULL');
        DB::statement('ALTER TABLE enquiries MODIFY city VARCHAR(255) NULL');
        DB::statement('ALTER TABLE enquiries MODIFY state VARCHAR(255) NULL');
    }

    public function down()
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }
        DB::statement("UPDATE enquiries SET email = '' WHERE email IS NULL");
        DB::statement("UPDATE enquiries SET city = '' WHERE city IS NULL");
        DB::statement("UPDATE enquiries SET state = '' WHERE state IS NULL");
        DB::statement('ALTER TABLE enquiries MODIFY email VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE enquiries MODIFY city VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE enquiries MODIFY state VARCHAR(255) NOT NULL');
    }
}
