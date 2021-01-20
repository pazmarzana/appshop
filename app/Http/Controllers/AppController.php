<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $apps = $user->appsComoDeveloper()->orderBy('id', 'DESC')->get();
                return view('index', compact('apps'));
            } else {
                $apps = DB::table('apps')
                    ->join('purchases', 'apps.id', '=', 'purchases.app_id')
                    ->select('apps.id as id', 'apps.name as name', 'price', 'image_path', 'developer')
                    ->where('purchases.user_id', '=', $user->id)
                    ->orderBy('apps.id', 'DESC')
                    ->get();
                $categories = Category::orderBy('name', 'ASC')->get();
                return view('index', compact('apps', 'categories'));
            }
        } else {
            $apps = App::orderBy('id', 'DESC')->get();
            $categories = Category::orderBy('name', 'ASC')->get();
            return view('index', compact('apps', 'categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $categories = Category::orderBy('name', 'ASC')->get();
                return view('create', compact('categories'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $validatedData = $this->validate($request, [
                    'name' => 'required|min:2',
                    'price' => 'required|numeric|min:0|max:20000000000',
                    'image_path' => 'required|active_url',
                    'category' => 'required|integer',
                ]); //termina validate

                $app = new App();
                $app->name = $request->input('name');
                $app->price = $request->input('price');
                $app->image_path = $request->input('image_path');
                $app->category_id = $request->input('category');
                $app->developer = $user->id;

                $app->save();
                return redirect()->route('apps.index')->with(array(
                    'message' => 'La app se ha guardado correctamente'
                ));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                return view('show', compact('app'));
            } else {
                return view('show', compact('app'));
            }
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $app = App::findOrFail($app->id);
                $categories = Category::orderBy('name', 'ASC')->get();
                return view('edit', compact('app', 'categories'));
            } else {
                return view('show', compact('app'));
            }
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $app)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $validatedData = $this->validate($request, [
                    'price' => 'required|numeric|min:0|max:20000000000',
                    'image_path' => 'required|active_url',

                ]); //termina validate

                $app = App::findOrFail($app->id);
                $app->price = $request->input('price');
                $app->image_path = $request->input('image_path');
                $app->update();

                return redirect()->route('apps.index')->with(array(
                    'message' => 'La modificacion se ha guardado correctamente'
                ));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                $app = App::findOrFail($app->id);

                foreach ($app->purchases as $purchase) {
                    $purchase->delete();
                }

                foreach ($app->wishes as $wish) {
                    $wish->delete();
                }

                $app->delete();
                return redirect()->route('apps.index')->with(array(
                    'message' => 'La aplicación se ha borrado correctamente'
                ));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }


    /* lista todas las aplicaciones para cualquiera que mira el sitio sin estar logueado.
    utiliza la misma vista index, pero pasa distintos parametros, las apps son todas */

    public function list()
    {
        // $apps = App::orderBy('name', 'ASC')->get();
        $apps = App::orderBy('id', 'DESC')->get();
        // $categories = Category::orderBy('name', 'ASC')->get();
        // return view('index', compact('apps', 'categories'));
        return view('index', compact('apps'));
        // return view('list', compact('apps'));
    }

    public function ver(App $app)
    {
        $app = App::findOrFail($app->id);
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                return back();
            } else {
                // var_dump($app);
                // die();
                //ver si es necesario user si no no pasarlo
                return view('show', compact('app', 'user'));
            }
        } else {
            return view('show', compact('app'));
        }
    }

    public function listarcategorias()
    {
        // $user = Auth::user();
        // if ($user->type == 1) {
        //     $categories = Category::orderBy('name', 'ASC')->get();
        //     return view('listarcategorias', compact('categories'));
        // } else {
        //     return back();
        // }

        $categories = Category::orderBy('name', 'ASC')->get();
        return view('listarcategorias', compact('categories'));
    }

    //por ahora no la voy a usar, si es cliente muestro solo las compradas (por categoria)
    public function listarxcategoria($id)
    {


        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                return back();
            } else {
                $apps = DB::table('apps')
                    ->join('purchases', 'apps.id', '=', 'purchases.app_id')
                    ->select('apps.id as appId', 'apps.name as appName', 'price', 'image_path', 'developer')
                    ->where('apps.category_id', '=', $id)
                    ->where('purchases.user_id', '=', $user->id)
                    ->orderBy('apps.id', 'DESC')
                    ->get();

                return view('xcategoria', compact('apps'));
            }
        } else {
            $apps = DB::table('apps')
                ->select('apps.id as appId', 'apps.name as appName', 'price', 'image_path', 'developer')
                ->where('apps.category_id', '=', $id)
                ->orderBy('apps.id', 'DESC')
                ->get();

            return view('xcategoria', compact('apps'));
        }
    }

    public function listarxcategoriaTodas($id)
    {


        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                return back();
            } else {
                $apps = DB::table('apps')
                    ->select('apps.id as appId', 'apps.name as appName', 'price', 'image_path', 'developer')
                    ->where('apps.category_id', '=', $id)
                    ->orderBy('apps.id', 'DESC')
                    ->get();

                return view('xcategoria', compact('apps'));
            }
        } else {
            $apps = DB::table('apps')
                ->select('apps.id as appId', 'apps.name as appName', 'price', 'image_path', 'developer')
                ->where('apps.category_id', '=', $id)
                ->orderBy('apps.id', 'DESC')
                ->get();

            return view('xcategoria', compact('apps'));
        }
    }
}
