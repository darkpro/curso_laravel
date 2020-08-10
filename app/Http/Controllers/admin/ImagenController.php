<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importar clases del modelo
use App\Imagen;
// Importar clase request de validacion
use App\Http\Requests\ImagenCreateRequest;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listado de registros
        // $Generos = User::all();                           // Obtener todos los registros
        // $Generos = User::orderBy('id', 'DESC')->get();    // Obtener todos los registros ordenados
        $imagenes = Imagen::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['imagenes'] = $imagenes;
        return view('admin.imagen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Renderizar formulario para nuevo registro
        return view('admin.imagen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(ImagenCreateRequest $request)
    {
        // Guardar datos del formulario
        // 1. Obtener todos los datos del formulario
        $imagen = new Imagen($request->all());
        $imagen->pelicula_id = 4;
        // 2. Cifrar password
        //$genero->password = bcrypt($user->password);
        // 3. Guardar en la base de datos
        $imagen->save();
        // 4. Mostrar mensaje
        //return 'Usuario registrado correctamente';
        flash('Imagen registrado correctamente')->success();
        // 5. Redireccionar a listado de usuarios
        return redirect()->route('imagen.index');
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
        $imagen = Imagen::find($id);
        $data['imagen'] = $imagen;
        return view('admin.imagen.edit', $data);
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
        $imagen = Imagen::find($id);
        // 2. Editar valores
        $imagen->pelicula_id = 4;
        $imagen->nombre = $request->nombre;
         // 3. Guardar cambios
        $imagen->save();
        // 4. Preparar mensaje
        flash('Imagen editado correctamente')->success();
        // 5. Redireccionar
        return redirect()->route('imagen.index');
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
        $imagen=Imagen::find($id);
        if($imagen){
            // 2. Eliminar registro
            $imagen->delete();
            // 3. Preparar mensaje
            flash('Se ha eliminado '.$imagen->nombre.' correctamente.')->success();
        }else{
            // Preparar mensaje de error
            flash('Error al eliminar, no existe el id '.$id.'.')->error();
        }
        // 4. Redireccionar
        return redirect()->route('imagen.index');
    }
}
