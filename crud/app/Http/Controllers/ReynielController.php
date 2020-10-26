<?php

namespace App\Http\Controllers;
use App\Models\User;  // <-- your model
use Illuminate\Http\Response;
use App\Traits\ApiResponser;  // <-- use to standardized our code for api response
use Illuminate\Http\Request;  // <-- handling http request in lumen


class ReynielController extends Controller
{
      use ApiResponser;
    //
private $data;

    function __construct(\App\Info $data){
        $this->data = $data;
    }

    public function index(){
        $datas = $this->data->paginate(20);
        return $datas;
    }

    public function store(Request $request){
        $input = $request->all();
        $data = $this->data->create($input);
        return[
            'data' => $data
        ];
    }
    public function show($id){
        $data = $this->data->findOrFail($id);

        if(!$data){
            abort(404);
        }
        return $data;
    }
    public function update(Request $request, $id){
        

        $data = $this->data->findOrFail($id);

        if(!$data){
         abort(404);
        }
        $data->fill($request->all());
        $data->save();

        return $data;

        
    }

    public function destroy($id){
        $data = $this->data->find($id);

        if(!$data){
            abort(404);
        }

        $data->delete();

        return ['message' => 'Successfully deleted!','data_id' => $data];

    }


    
}
