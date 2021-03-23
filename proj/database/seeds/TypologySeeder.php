<?php

use Illuminate\Database\Seeder;

use App\Typology;
use App\User;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $typologies = [
          'Giapponese',
          'Brasiliano',
          'Cinese',
          'Colazione',
          'Dolci e dessert',
          'Fast food',
          'Indiano',
          'Italiano',
          'Greco',
          'Messicano',
          'Pizzeria',
          'Libanese',
        ];
        $logos = [
          "https://www.italiaatavola.net/images/contenutiarticoli/Sushi-salute-quali-rischi-Anche-riso-puo-far-danni-1.jpg",
          "http://www.ristorantebrasiliano.net/wp-content/uploads/2015/08/ristorante-brasiliano-espeto-picanha-torino-asti--1024x683.jpg",
          "https://images.chinahighlights.com/allpicture/2019/11/a4ad4a7fe0cb401cb0be6383_894x598.jpg",
          "https://www.italiaatavola.net/images/contenutiarticoli/prima-colazione-business.jpg",
          "https://images.lacucinaitaliana.it/gallery/77321/Big/0b00ef79-3c41-4b0d-9cc3-f65bc2d67c44.jpg",
          "https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8aGFtYnVyZ2VyfGVufDB8fDB8&ixlib=rb-1.2.1&w=1000&q=80",
          "https://bigapplecurry.files.wordpress.com/2012/11/istock_000019639558_medium.jpg",
          "https://www.cucchiaio.it/content/cucchiaio/it/ricette/2019/12/spaghetti-al-pomodoro/jcr:content/header-par/image-single.img10.jpg/1576681061599.jpg",
          "https://previews.123rf.com/images/anaumenko/anaumenko1905/anaumenko190500072/123097127-selection-of-traditional-greek-food.jpg",
          "https://share.upmc.com/wp-content/uploads/2016/05/healthy-mexican-food-740x493.jpg",
          "https://static.cookist.it/wp-content/uploads/sites/21/2018/03/pizza-3000274-960-720.jpg",
          "https://blog.radissonblu.com/wp-content/uploads/2019/05/GettyImages-955998652.jpg",
        ];

        // foreach ($typologies as $typology) {
        //   $newtypology = new Typology();
        //   $newtypology -> type = $typology;
        //   $newtypology -> save();
        //
        //   $users = User::inRandomOrder()
        //   ->limit(rand(1,5)) ->get();
        //   $newtypology -> users() -> attach($users);
        // }

        for ($i=0; $i < count($typologies) ; $i++) {
          $newtypology = new Typology();
          $newtypology -> type = $typologies[$i];
          $newtypology -> logo = $logos[$i];
          $newtypology -> save();

          $users = User::inRandomOrder()
          ->limit(rand(1,5)) ->get();
          $newtypology -> users() -> attach($users);
        }

        // factory(Typology::class, 10)->create()->each(function ($typology) {
        //     $user = User::inRandomOrder()->limit(rand(1, 5))->get();
        //     $typology->users()->attach($user);
        // });

    }
}
