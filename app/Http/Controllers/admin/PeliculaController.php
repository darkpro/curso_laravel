<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\Pelicula;
use App\Genero;
use App\Director;
use App\Imagen;
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
        $data['generos']= Genero::OrderBy('genero','ASC')->pluck('genero','id');
        //dd( $data['generos']);
        //Obteneer el listado de los directores
        $data['directores']= Director::OrderBy('nombre','ASC')->pluck('nombre','id');
       // $data['generos'] = null;
        //dd( $data['generos']);
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
        $pelicula->genero_id = $request->genero_id;
        $pelicula->save();
        $pelicula->directores()->sync($request->directores);
        $file_name ='';
        if($request->file('imagen'))
        {
          $file  = $request->file('imagen');
          $file_name = 'cinema_'.time().'.'.$file->getClientOriginalExtension();
          $file_path = public_path().'/imagenes/pelicula';
          $file->move($file_path, $file_name);
        }

        $imagen = new Imagen();
        $imagen->nombre = $file_name;
        $imagen->pelicula()->associate($pelicula);
        $imagen->save();


        //return 'Usuario registrado correctamente';
        flash('Pelicula registrado correctamente')->success();
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
        $data['generos']= Genero::OrderBy('genero','ASC')->pluck('genero','id');
        //dd( $data['generos']);
        //Obteneer el listado de los directores
        $data['directores']= Director::OrderBy('nombre','ASC')->pluck('nombre','id');

        $data['directoressel'] = $pelicula->directores();
        $data['imagensel'] = $pelicula->imagenes();
        //dd( $pelicula->imagenes()->first());
        //$imagen = Imagen::find($id);
        $data['imagensel'] =  $pelicula->imagenes()->first()->nombre;
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
        $pelicula->user_id = 2;
        $pelicula->genero_id = $request->genero_id;
        $pelicula->save();
        $pelicula->directores()->sync($request->directores);
        $file_name ='';
        if($request->file('imagen'))
        {
            $imagenlast = Imagen::find($pelicula->imagenes()->first()->id);
            if($imagenlast){
                $imagenlast->delete();
            }

          $file  = $request->file('imagen');
          $file_name = 'cinema_'.time().'.'.$file->getClientOriginalExtension();
          $file_path = public_path().'/imagenes/pelicula';
          $file->move($file_path, $file_name);
        }

        $imagen = new Imagen();
        $imagen->nombre = $file_name;
        $imagen->pelicula()->associate($pelicula);
        $imagen->save();


        //return 'Usuario registrado correctamente';
        flash('Pelicula modificada correctamente')->success();
        // 5. Redireccionar a listado de usuarios
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
