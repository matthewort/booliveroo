<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('orders', function (Blueprint $table) {

          // specifico associazione fk e tabella dishes
          $table -> foreign('user_id' , 'user-orders')
          -> references('id')
          -> on('users');

      });

      Schema::table('dishes', function (Blueprint $table) {

          // specifico associazione fk e tabella dishes
          $table -> foreign('user_id' , 'user-dishes')
          -> references('id')
          -> on('users');

      });

      Schema::table('typology_user', function (Blueprint $table) {

        // specifico associazione fk e tabella ponte typology_user
       $table -> foreign('typology_id' , 'tu-typology')
              -> references('id')
              -> on('typologies');
               //tu(typology_user abbreviazione)nome richiamo in down
       $table -> foreign('user_id' , 'tu-user')
              -> references('id')
              -> on('users');
        //tu(typology_user abbreviazione) nome richiamo in down
      });

      Schema::table('dish_order', function (Blueprint $table) {

       $table -> foreign('dish_id' , 'do-dish')
              -> references('id')
              -> on('dishes');
       $table -> foreign('order_id' , 'do-order')
              -> references('id')
              -> on('orders');
         // specifico associazione fk e tabella ponte dish_order
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

            // down() contiene stessi elementi up() al contrario che vengono asfaltati nel processo rolling-back terminale(durante refresh/ refresh --seed)
      Schema::table('dish_order', function (Blueprint $table) {

        // inserisco in ordine inverso anche contenuto delle varie table
        $table -> dropForeign('do-order');
        $table -> dropForeign('do-dish');

      });

      Schema::table('typology_user', function (Blueprint $table) {

        $table -> dropForeign('tu-user');
        $table -> dropForeign('tu-typology');

      });

      Schema::table('dishes', function (Blueprint $table) {

       $table -> dropForeign('user-dishes');

      });

      Schema::table('orders', function (Blueprint $table) {

       $table -> dropForeign('user-orders');

      });

    }
}
