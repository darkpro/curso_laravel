<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\Pelicula;
use App\Genero;
// Importar clase request de validacion
use App\Http\Requests\PeliculaCreateRequest;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listado de registros
        // $peliculas = Pelicula::all();                           // Obtener todos los registros
        // $peliculas = Pelicula::orderBy('id', 'DESC')->get();    // Obtener todos los registros ordenados
        $peliculas = Pelicula::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['peliculas'] = $peliculas;
        return view('admin.pelicula.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Renderizar formulario para nuevo registro
        /*
        $vgeneros = Genero::orderBy('id', 'DESC')->orderBy('genero')->lists('id','genero'); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $generos= Item::pluck('Selecione Uno','s');
        foreach($vgeneros as $genero )
        {
            $generos= Item::pluck($genero->genero,$genero->id);

        }
        */
        $data['generos'] = null;
        return view('admin.pelicula.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(PeliculaCreateRequest $request)
    {
        // Guardar datos del formulario
        // 1. Obtener todos los datos del formulario
        $pelicula = new Pelicula($request->all());
        // 2. Cifrar password
        //$pelicula->password = bcrypt($pelicula->password);
        // 3. Guardar en la base de datos
        $pelicula->user_id = 2;
        $pelicula->genero_id = 1;
        $pelicula->save();
        // 4. Mostrar mensaje
        //return 'Usuario registrado correctamente';
        flash('Usuario registrado correctamente')->success();
        // 5. Redireccionar a listado de usuarios
        return redirect()->route('pelicula.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostrar informacion detallada
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Renderizar formulario para editar
        $pelicula = Pelicula::find($id);
        // dd($pelicula);
        $data['pelicula'] = $pelicula;
        //$generos = Genero::orderBy('id', 'DESC')->orderBy('genero')->lists('genero', 'id'); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        //$data['generos'] = $generos;
        return view('admin.pelicula.edit', $data);
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
        // Registrar cambios en la base de datos
        // dd($request->all());
        // 1. Buscar registro a modificar
        $pelicula = Pelicula::find($id);
        // 2. Editar valores
        $pelicula->titulo = $request->titulo;
        $pelicula->costo = $request->costo;
        $pelicula->resumen = $request->resumen;
        $pelicula->estreno = $request->estreno;
        $pelicula->genero_id = 1;
        $pelicula->user_id = 2;
        // 3. Guardar cambios
        $pelicula->save();
        // 4. Preparar mensaje
        flash('Pelicula editado correctamente')->success();
        // 5. Redireccionar
        return redirect()->route('pelicula.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar un registro
        // 1. Buscar registro a eliminar
        $pelicula=Pelicula::find($id);
        if($pelicula){
            // 2. Eliminar registro
            $pelicula->delete();
            // 3. Preparar mensaje
            flash('Se ha eliminado '.$pelicula->name.' correctamente.')->success();
        }else{
            // Preparar mensaje de error
            flash('Error al eliminar, no existe el id '.$id.'.')->error();
        }
        // 4. Redireccionar
        return redirect()->route('pelicula.index');
    }
}
