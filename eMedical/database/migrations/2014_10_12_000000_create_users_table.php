<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles',function (Blueprint $table) {
            $table->string('name');
            $table->id();
            $table->timestamps();
        });

        $roles=['Patient','Doctor','Admin'];

        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        Schema::create('users', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique()->primary();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('role_id')->default(1); 
            $table->rememberToken();
            $table->timestamps();
        });

        $admin=User::create([
            'email' => 'admin@emedical.com',
            'name'  => 'eMedicalAdmin',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now()->timestamp,
            'role_id' => 3
        ]);

        Schema::create('patients', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->foreign('email')->references('email')->on('users');
            $table->string('id',10)->unique(); #12345678Z ó Z12345678A
            $table->string('healthcare_number',10)->unique();
            $table->dateTime('birthday');
            $table->string('occupation');
            $table->string('address');
            $table->string('phone_number',20);
            $table->timestamps();
        });

        Schema::create('doctors', function (Blueprint $table) {
            $table->string('id',9)->unique(); 
            $table->string('email')->unique();
            $table->foreign('email')->references('email')->on('users');
            $table->string('specialty');
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
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');

    }
}
