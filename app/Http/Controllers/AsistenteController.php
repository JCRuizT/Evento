<?php

namespace App\Http\Controllers;

use Validator;
use App\Asistente;
use Illuminate\Http\Request;


class AsistenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Asistente::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'identification_card' => 'required|unique:asistente|string',
            'gender' => 'required|max:2|integer',
            'birthdate' => 'required',
        ]);

        
        if($validator->fails()){

            
            return response()->json([
                
                'error' => true,
            ]);

        }else{
            

            if(is_numeric($request->identification_card)){
                
            $nowYear = date("Y");
            $ageYear = date("Y", strtotime($request->birthdate));

            $nowDay = date("j");
            $ageDay = date("j",strtotime($request->birthdate));

            $nowMonth = date("M");
            $ageMonth = date("M",strtotime($request->birthdate));



            if ($nowYear - $ageYear >= 18) {

                $this->age(new Asistente,$request);
            } else if ($nowYear - $ageYear == 17) {
                
                if ($nowMonth > $ageYear) {
                    $this->age(new Asistente,$request);
                } else if ($nowMonth == $ageMonth) {
                    if ($nowDay >= $ageYear) {
                         $this->age(new Asistente,$request);
                    } else {
                        return response()->json([
                
                            'error' => true
                        ]);
                    }
                } else {
                    return response()->json([
                
                        'error' => true
                    ]);
                }
            }else{

                return response()->json([
                
                    'error' => true
                ]);
            }


        }else{

            return response()->json([
                
                'error' => true,
            ]);

        }

     }
        
    }


    private function age($asistente,$request){

        $asistente->name = $request->name;
        $asistente->identification_card = $request->identification_card;
        $asistente->gender = $request->gender;
        $asistente->birthdate = $request->birthdate;
        $asistente->save();
    }



    /**
     * Remove the specified resource from storage.
     * gfgfgfggfgf
     * @param  \App\Asistente  $asistente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistente $asistente)
    {


            $asistente->delete();
    }        
        

}

