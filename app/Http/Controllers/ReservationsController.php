<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Route;
use App\Models\Reservation;
use App\Models\ReservationItem;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }


    public function index(Request $req)
    {
      $user = auth()->user();

      if ($user->role_id == 1)
        $reservations = Reservation::all();
      else 
        $reservations = DB::table('reservations')->where('user_id', '=', $user->id)->get();
      
        $routes = Route::all();

      return view('reservations.index', ['reservations' => $reservations, 'routes' => $routes]);
    }


    public function show(Reservation $reservation) {

      $route = Route::findOrFail($reservation->route_id);

      $items = DB::table('reservation_item')->where('reservation_id', '=', $reservation->id)->get();

      return view('reservations.show', ['reservation' => $reservation, 'items' => $items, 'route' => $route]);
    }


    public function showDelete(Reservation $reservation) {
      return view('reservations.delete', ['reservation' => $reservation]);
    }


    public function create(Route $route)
    {
      $route = Route::findOrFail($route->id);
      $items = Item::all();
      $user = auth()->user();

      return view('reservations.create', ['route' => $route, 'items' => $items, 'user' => $user]);
    }

    public function store(Request $request, Route $route) 
    {
      $request->validate([
        'data_from' => 'required',
        'data_to' => 'required'
      ]);

      $items = Item::all();
      $user = auth()->user();

      $count_baidariu = $request->baidare;
      $count_kanoju = $request->kanoja;
      $count_valciu = $request->valtis; 

      $reservation_price = $count_baidariu * $items[1]->price +
                            $count_kanoju * $items[0]->price +
                            $count_valciu * $items[2]->price;

      $reservation_fee = $user->reservations_number > 10 ? 0 : 12.99;

      $discount = 0;
      if ($reservation_price >= 200 && $reservation_price < 250) {
        $discount = 3;
      } else if ($reservation_price >= 250 && $reservation_price < 400) {
        $discount = 5;
      } else if ($reservation_price >= 400) {
        $discount = 10;
      }

      if ($user->reservations_cost > 1000) {
        $discount += 3;
      } else if ($user->reservations_cost > 2000) {
        $discount += 5;
      } else if ($user->reservation_cost > 3000) {
        $discount += 10;
      }

      $reservation = new Reservation();

      $reservation->data_from = $request->data_from;
      $reservation->data_to = $request->data_to;
      $reservation->reservation_price = $reservation_price;
      $reservation->reservation_fee = $reservation_fee;
      $reservation->discount = $discount;
      $reservation->created_at = Date::now();
      $reservation->route_id = $route->id;
      $reservation->user_id = $user->id;

      $reservation->save();

      $reservationBaidares = new ReservationItem();
      $reservationKanojos = new ReservationItem();
      $reservationValtys = new ReservationItem();

      $reservationBaidares->count = $count_baidariu;
      $reservationBaidares->reservation_id = $reservation->id;
      $reservationBaidares->item_id = 2;

      $reservationKanojos->count = $count_kanoju;
      $reservationKanojos->reservation_id = $reservation->id;
      $reservationKanojos->item_id = 1;

      $reservationValtys->count = $count_valciu;
      $reservationValtys->reservation_id = $reservation->id;
      $reservationValtys->item_id = 3;

      $reservationBaidares->save();
      $reservationKanojos->save();
      $reservationValtys->save();

      $totalDiscount = $reservation_price * ($discount / 100);
      $totalPrice = $reservation_price - $totalDiscount;
      User::where('id', $user->id)->update(['reservations_number' => $user->reservations_number + 1,
                                            'reservations_cost' => round($user->reservations_cost + ($reservation_fee + $totalPrice), 2)]);

      return redirect('/marsrutai');
    }

    
    public function edit(Reservation $reservation)
    {
      $user = auth()->user();
      $items = DB::table('reservation_item')->where('reservation_id', '=', $reservation->id)->get();

        return view('reservations.edit', [
            'reservation' => $reservation,
            'items' => $items,
            'user' => $user
        ]);
    }


    public function update(Request $request, Reservation $reservation) 
    {

      $items = DB::table('reservation_item')->where('reservation_id', '=', $reservation->id)->get();
      $user = auth()->user();

      $oldPrice = $reservation->reservation_price + $reservation->reservation_fee - ($reservation->reservation_price * ($reservation->discount / 100));

      $count_baidariu = $request->baidare;
      $count_kanoju = $request->kanoja;
      $count_valciu = $request->valtis; 

      $reservation_price = $count_baidariu * 50 +
                            $count_kanoju * 40 +
                            $count_valciu * 70;

      $reservation_fee = $user->reservations_number > 10 ? 0 : 12.99;

      $discount = 0;
      if ($reservation_price >= 200 && $reservation_price < 250) {
        $discount = 3;
      } else if ($reservation_price >= 250 && $reservation_price < 400) {
        $discount = 5;
      } else if ($reservation_price >= 400) {
        $discount = 10;
      }

      if ($user->reservations_cost > 1000) {
        $discount += 3;
      } else if ($user->reservations_cost > 2000) {
        $discount += 5;
      } else if ($user->reservation_cost > 3000) {
        $discount += 10;
      }

      Reservation::where('id', $reservation->id)->update([
        'data_from' => $request->data_from,
        'data_to' => $request->data_to,
        'reservation_price' => $reservation_price,
        'reservation_fee' => $reservation_fee,
        'discount' => $discount,
        'route_id' => $reservation->route_id,
        'user_id' => $reservation->user_id,
        'status' => $request->status
      ]);

      ReservationItem::where([['reservation_id', '=', $reservation->id], ['item_id', '=', 2]])->update(['count' => $count_baidariu]);
      ReservationItem::where([['reservation_id', '=', $reservation->id], ['item_id', '=', 1]])->update(['count' => $count_kanoju]);
      ReservationItem::where([['reservation_id', '=', $reservation->id], ['item_id', '=', 3]])->update(['count' => $count_valciu]);

      $totalDiscount = $reservation_price * ($discount / 100);
      $totalPrice = $reservation_price - $totalDiscount;
      User::where('id', $user->id)->update(['reservations_cost' => round($user->reservations_cost - $oldPrice + ($reservation_fee + $totalPrice), 2)]);

      return redirect('/rezervacijos/'.$reservation->id);
    }


    public function destroy(Reservation $reservation)
    {
      $totalDiscount = $reservation->reservation_price * ($reservation->discount / 100);
      $totalPrice = $reservation->reservation_price - $totalDiscount + $reservation->reservation_fee;

      $user = User::where('id', $reservation->user_id)->first();

      User::where('id', $user->id)->update(['reservations_number' => $user->reservations_number - 1,
                                            'reservations_cost' => round($user->reservations_cost - $totalPrice, 2)]);


      Reservation::where('id', $reservation->id)->delete();

      return redirect('/rezervacijos');
    }
}
