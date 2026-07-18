<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique(); // kode tracking, cth: WTN-20260719-0001
            $table->string('customer_name');
            $table->string('phone');
            $table->text('item_description'); // deskripsi barang yang dikerjakan
            $table->string('photo')->nullable(); // foto barang saat order
            $table->enum('service_type', ['powder_coating', 'vaporblasting', 'both'])->default('powder_coating');

            // status ACC dari admin
            $table->enum('acc_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();

            // tahap progres saat ini
            $table->enum('current_stage', [
                'menunggu_acc',
                'cleaning',
                'remove_cat',
                'remove_chrome',
                'sandblasting',
                'vaporblasting',
                'powder_coating',
                'oven',
                'finishing',
                'done',
            ])->default('menunggu_acc');

            $table->integer('queue_number')->nullable(); // nomor antrean
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
