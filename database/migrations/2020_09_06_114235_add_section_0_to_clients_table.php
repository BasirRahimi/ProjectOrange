<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSection0ToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('honorific')->nullable()->after('user_id');
            $table->string('forename')->nullable()->after('honorific');
            $table->string('surname')->nullable()->after('forename');
            $table->string('aliases')->nullable()->after('surname');
            $table->string('addressline1')->nullable()->after('aliases');
            $table->string('addressline2')->nullable()->after('addressline1');
            $table->string('city')->nullable()->after('addressline2');
            $table->string('postcode')->nullable()->after('city');
            $table->date('date_of_death')->nullable()->after('postcode');

            $table->string('place_of_birth')->nullable()->after('date_of_death');
            $table->string('place_of_death')->nullable()->after('place_of_birth');

            $table->string('marital_status')->nullable()->after('place_of_death');

            $table->boolean('spouse')->nullable()->after('marital_status');
            $table->tinyInteger('parents')->nullable()->after('spouse');
            $table->tinyInteger('siblings')->nullable()->after('parents');
            $table->tinyInteger('children')->nullable()->after('siblings');
            $table->tinyInteger('grand_children')->nullable()->after('children');

            $table->string('national_insurance_number')->nullable()->after('grand_children');
            $table->string('income_tax_reference')->nullable()->after('national_insurance_number');
            $table->string('accountant_phone')->nullable()->after('income_tax_reference');
            $table->string('accountant_email')->nullable()->after('accountant_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('honorific');
            $table->dropColumn('forename');
            $table->dropColumn('surname');
            $table->dropColumn('aliases');
            $table->dropColumn('addressline1');
            $table->dropColumn('addressline2');
            $table->dropColumn('city');
            $table->dropColumn('postcode');
            $table->dropColumn('date_of_death');

            $table->dropColumn('place_of_birth');
            $table->dropColumn('place_of_death');

            $table->dropColumn('marital_status');

            $table->dropColumn('spouse');
            $table->dropColumn('parents');
            $table->dropColumn('siblings');
            $table->dropColumn('children');
            $table->dropColumn('grand_children');

            $table->dropColumn('national_insurance_number');
            $table->dropColumn('income_tax_reference');
            $table->dropColumn('accountant_phone');
            $table->dropColumn('accountant_email');
        });
    }
}
