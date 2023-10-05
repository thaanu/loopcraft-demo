<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('shop_products', function (Blueprint $table) {

            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('sku');
            $table->dropColumn('barcode');
            $table->dropColumn('description');
            $table->dropColumn('qty');
            $table->dropColumn('security_stock');
            $table->dropColumn('featured');
            $table->dropColumn('is_visible');
            $table->dropColumn('old_price');
            $table->dropColumn('price');
            $table->dropColumn('cost');
            $table->dropColumn('type');
            $table->dropColumn('backorder');
            $table->dropColumn('requires_shipping');
            $table->dropColumn('published_at');
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->dropColumn('weight_value');
            $table->dropColumn('weight_unit');
            $table->dropColumn('height_value');
            $table->dropColumn('height_unit');
            $table->dropColumn('width_value');
            $table->dropColumn('width_unit');
            $table->dropColumn('depth_value');
            $table->dropColumn('depth_unit');
            $table->dropColumn('volume_value');
            $table->dropColumn('volume_unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
