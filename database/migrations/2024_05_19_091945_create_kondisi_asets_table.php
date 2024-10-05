<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kondisi_aset', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi', 20);
        });

        // Insert default conditions
        DB::table('kondisi_aset')->insert([
            ['kondisi' => 'baik'],
            ['kondisi' => 'rusak'],
            ['kondisi' => 'usang'],
            ['kondisi' => 'hilang']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kondisi_aset');
    }
};
