<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('employees'))
        {
            Schema::create('employees', function (Blueprint $table)
            {
                $table->id();
                $table->string("first_name", 50);
                $table->string("last_name", 50);
                $table->string("email", 50)->unique();
                $table->string("phone", 20);
                $table->string("department", 50);
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->index(["first_name", "last_name", "email", "phone", "department"], "search_index");
                $table->dateTime("hire_date");
            });
        }
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
};
