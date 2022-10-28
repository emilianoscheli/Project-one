<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\JwtAuth;
use App\Productos;

class ProductosController extends Controller
{
    public function index(){
    	$productos = Productos::all();
    	return response()->json(array(
    			'productos' => $productos,
    			'status' => 'success'
    		), 200);
    }

    public function show($id){

           $productos = Productos::find($id);       

        if(is_object($productos)){
            //$productos = Productos::find($id)->load('user');
            $productos = Productos::find($id);

            return response()->json(array('productos' => $productos, 'status' => 'success'),200);
        }else{
            return response()->json(array('message' => 'El producto no existe', 'status' => 'error'),200);
        }
    	
    }

    public function store(Request $request){

			// Recoger datos por POST
			$json = $request->input('json', null);
			$params = json_decode($json);	
			$params_array = json_decode($json, true);

			// Conseguir el usuario identificado

    		// Validación
	    	$validate = \Validator::make($params_array, [
	    		'title' => 'required|min:5',
	    		'description' => 'required',
	    		'price' => 'required',
	    		'status' => 'required'
	    	]);

	    	if($validate->fails()){
	    		return response()->json($validate->errors(), 400);
	    	}


    		// Guardar el producto
    		$productos = new Productos();
    		$productos->user_id = null;
    		$productos->title = $params->title;
    		$productos->description = $params->description;
    		$productos->price = $params->price;
    		$productos->status = $params->status;
    		$productos->save();
    		
    		$data = array(
    			'productos' => $productos,
    			'status' => 'success',
    			'code' => 200,
    		);



    	return response()->json($data, 200);
    }


    public function update($id, Request $request){
   
    		// Recoger parametros POST
    		$json = $request->input('json', null);
    		$params = json_decode($json);
    		$params_array = json_decode($json, true);

    		// Validar datos
	    	$validate = \Validator::make($params_array, [
	    		'title' => 'required|min:5',
	    		'description' => 'required',
	    		'price' => 'required',
	    		'status' => 'required'
	    	]);

	    	if($validate->fails()){
	    		return response()->json($validate->errors(), 400);
	    	}

    		// Actualizar el registro
            unset($params_array['id']);
            //unset($params_array['user_id']);
            unset($params_array['created_at']);
          //  unset($params_array['user']);
            
    		$productos = Productos::where('id', $id)->update($params_array);

    		$data = array(
    			'productos' => $params,
    			'status' => 'success',
    			'code' => 200
    		);



    	return response()->json($data, 200);
    }

    public function destroy($id, Request $request){

    		// Comprobar que existe el registro
    		$productos = Productos::find($id);

    		// Borrarlo
    		$productos->delete();

    		// Devolverlo
    		$data = array(
    			'productos' => $productos,
    			'status' => 'success',
    			'code' => 200
    		);

            

    

    	return response()->json($data, 200);
    }

}// end class
