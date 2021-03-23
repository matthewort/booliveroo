<?php
// Controller
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;

class LiveSearch extends Controller
{
    function index(){
     return view('clientPage.live_search');
    }

    function action(Request $request){
      if($request->ajax()){
        $output = '';
        $query = $request->get('query');

        $users = DB::table('users')
          ->get();

        if($query != ''){
          //mostra tutti i dishes corrispodenti a ciò che è stato inserito nella searchbar
          $data = DB::table('typologies')
            ->where('type', 'like', '%'.$query.'%')
            ->orderBy('type', 'desc')
            ->get();
        }else{
          //altrimenti mostra tutti i dishes fino a quando non inserisco qualcosa qualcosa nella searchbar
          $data = DB::table('typologies')
            ->orderBy('type', 'desc')
            ->get();
        }
        $total_row = $data->count();
        if($total_row > 0){
          //una volta eseguita la ricerca, se il totale delle righe è maggiore di 0 mostrami una tabella con tutti i risultati
          // foreach($data as $row){
          //   $output .=
          //
          //     $row -> type . '<br>'
          //
          //   ;
          // }

          foreach($users as $user){
            $output .=

              '<a href="' . route('user-show', $user -> id ) . '">' . $user -> name . '</a>' . '<br>'

            ;

          }
        }else{
          //altrimenti mostra No Data Found ($total_row=0)
          $output = '
          <tr>
            <td align="center" colspan="5">No Data Found</td>
          </tr>
          ';
        }
        $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
        );

        echo json_encode($data);
      }
    }
}
