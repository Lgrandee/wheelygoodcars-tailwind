<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('bets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Verwijst naar de car tabel
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Verwijst naar de user tabel
        $table->decimal('bid_amount', 10, 2); // Het geboden bedrag
        $table->timestamps();
    });
}
};
