<?php

namespace App\Http\Controllers;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class RoutesController extends Controller
{
    public function index(Request $req)
    {
      $lengths = DB::table('routes')->select('length')->distinct()->orderBy('length')->get();

      if ($req->sor) {
        $routes = DB::table('routes')
          ->where([
            ['status', '!=', 'Pašalintas'],
            $req->diff != null ? ['difficulty', 'like', $req->diff] : ['difficulty', '!=', '-'],
            $req->len != null ? ['length', 'like', $req->len] : ['length', '!=', '-']])
          ->orderBy('difficulty', $req->sor)->orderBy('length', $req->sor)->get();
      } else {
        $routes = DB::table('routes')
          ->where([
            ['status', '!=', 'Pašalintas'],
            $req->diff != null ? ['difficulty', 'like', $req->diff] : ['difficulty', '!=', '-'],
            $req->len != null ? ['length', 'like', $req->len] : ['length', '!=', '-']])
          ->get();
      }

      return view('routes.index', ['routes' => $routes, 'lengths' => $lengths]);
    }


    public function show(Route $route) {

      $route = Route::findOrFail($route->id);

      return view('routes.show', ['route' => $route]);
    }


    public function showDelete(Route $route) {

      $route = Route::findOrFail($route->id);

      return view('routes.delete', ['route' => $route]);
    }


    public function create()
    {
        return view('routes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'difficulty' => 'required',
            'length' => 'required',
            'description' => 'required',
            'photo' => 'required'
        ]);

        $route = new Route();

        $route->name = $request->name;
        $route->difficulty = $request->difficulty;
        $route->length = $request->length;
        $route->description = $request->description;
        $route->photo = $request->photo;
        $route->created_at = Date::now();
        $route->updated_at = Date::now();

        $route->save();

        return redirect('/marsrutai');
    }


    public function edit(Route $route)
    {
        return view('routes.edit', [
            'route' => $route
        ]);
    }


    public function update(Request $request, Route $route)
    {
        $route->name = $request->name;
        $route->difficulty = $request->difficulty;
        $route->length = $request->length;
        $route->description = $request->description;
        $route->photo = $request->photo;
        $route->updated_at = Date::now();

        $route->save();

        return redirect('/marsrutai/'.$route->id);
    }

    
    public function destroy(Route $route)
    {
      $route->status = 'Pašalintas';

      $route->save();

      return redirect('/marsrutai');
    }
}
