<?php

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string(Employee::FIRST_NAME, 100);
            $table->string(Employee::LAST_NAME, 100);
            $table->string(Employee::EMAIL, 100)->nullable();
            $table->unsignedBigInteger(Employee::COMPANY_ID);
            $table->foreign(Employee::COMPANY_ID)->references('id')->on(Company::TABLE);
            $table->string(Employee::PHONE, 11);
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
        Schema::dropIfExists('employees');
    }
}
