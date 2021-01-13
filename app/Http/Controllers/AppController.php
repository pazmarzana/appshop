<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->type == 0) {
            $apps = $user->appsComoDeveloper()->orderBy('id', 'DESC')->get();
            return view('index', compact('apps'));
        } elseif ($user->type == 1) {
            $apps = App::orderBy('id', 'DESC')->get();
            $categories = Category::orderBy('name', 'ASC')->get();
            return view('indexcliente', compact('apps', 'categories'));
        } else {
            $apps = App::orderBy('id', 'DESC')->get();
            return view('list', compact('apps'));
        }


        // if (!empty($apps)) {
        //     return view('index', compact('apps'));
        // } else {
        //     return back();
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->type == 0) {
            $categories = Category::orderBy('name', 'ASC')->get();
            return view('create', compact('categories'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        $user = Auth::user();
        if ($user->type == 0) {
            return view('show', compact('app'));
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
        $user = Auth::user();
        if ($user->type == 0) {
            $app = App::findOrFail($app->id);
            $categories = Category::orderBy('name', 'ASC')->get();
            return view('edit', compact('app', 'categories'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {
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
    }


    /* lista todas las aplicaciones para cualquiera que mira el sitio sin estar logueado. */

    public function list()
    {
        // $apps = App::orderBy('name', 'ASC')->get();
        $apps = App::orderBy('id', 'DESC')->get();
        return view('list', compact('apps'));
    }
}
