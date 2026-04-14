<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('id');
            $table->string('contact_no')->nullable()->after('email');
            $table->string('profession')->nullable()->after('contact_no');
            $table->string('education')->nullable()->after('profession');
            $table->date('dob')->nullable()->after('education');
            $table->time('time_of_dob')->nullable()->after('dob');
            $table->string('gender')->nullable()->after('time_of_dob');
            $table->text('address')->nullable()->after('gender');
            $table->string('city')->nullable()->after('address');
            $table->string('father_name')->nullable()->after('city');
            $table->string('father_occupation')->nullable()->after('father_name');
            $table->string('mother_name')->nullable()->after('father_occupation');
            $table->string('mother_occupation')->nullable()->after('mother_name');
            $table->text('siblings')->nullable()->after('mother_occupation');
            $table->text('maternal_relatives')->nullable()->after('siblings');
            $table->string('marital_status')->nullable()->after('maternal_relatives');
            $table->decimal('height', 6, 2)->nullable()->after('marital_status');
            $table->decimal('weight', 6, 2)->nullable()->after('height');
            $table->text('about')->nullable()->after('weight');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'photo',
                'contact_no',
                'profession',
                'education',
                'dob',
                'time_of_dob',
                'gender',
                'address',
                'city',
                'father_name',
                'father_occupation',
                'mother_name',
                'mother_occupation',
                'siblings',
                'maternal_relatives',
                'marital_status',
                'height',
                'weight',
                'about',
            ]);
        });
    }
};
