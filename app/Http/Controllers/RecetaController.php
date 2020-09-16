<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtener recetas del usuario autenticado
       // Auth::user()->recetas->dd(); ó auth()::users()
       $recetas = auth()->user()->recetas;

        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //list OBTENER CATEGORIAS SIN MODELO
        // $categorias  = DB::table('categoria_recetas')->get()->pluck('nombre','id');

        //consulta de CATEGORIAS CON MODELO
        $categorias = CategoriaReceta::all(['id','nombre']);

        //
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //probando save de image
        //dd( $request['imagen']->store('upload-recetas', 'aws'));
        //dd( $request['imagen']->store('upload-recetas', 'public'));

        //Validacion
        $data = $request->validate([
            'titulo'=> 'required|min:6',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image', //sixe:1000
           'categoria'=>'required',
           ]);

            //Obtener la ruta de la imagen
        $ruta_imagen =  $request['imagen']->store('upload-recetas', 'public');
            //Resize de la imagen con intervention image composer require intervention/image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))-> fit(1000, 550);
        $img->save();

        //Almacenar en la base de datos (SIN MODELO)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        // ]);


        //ALMACENAR EN LA BD CON MODELO / recetas el del modelo user
            auth()->user()->recetas()->create([
                'titulo' => $data['titulo'],
                'preparacion' => $data['preparacion'],
                'ingredientes' => $data['ingredientes'],
                'imagen' => $ruta_imagen,
                'categoria_id' => $data['categoria'],
            ]);

        
       // dd( $request->all() );
       //REDIRECCIONA
       return redirect()->action('RecetaController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {   //algunos metodos para obtener una receta si viene asi show($id)   $receta = Receta::findOrFail($id);
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
