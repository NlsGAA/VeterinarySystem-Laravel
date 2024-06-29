<?php

namespace App\Http\Controllers;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Http\Controllers\Controller;
use App\Services\PatientsServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{
    public function __construct(
        private PatientsServices $patientsServices
    ){}

    public function store(Request $request)
    {
        try {
            
            $patient = $this->patientsServices->create(new CreatePatientDTO($request));
        } catch (Exception $e) {
            return $e;
        }
        return response()->json($patient, 200);
        // $registerPatient = new Patient();

        // $registerPatient->nome = $request->nome;
        // $registerPatient->raca = $request->raca;
        // $registerPatient->especie = $request->especie;
        // $registerPatient->peso = $request->peso;
        // $registerPatient->tipoPeso = $request->tipoPeso;
        // $registerPatient->coloracao = $request->coloracao;
        // $registerPatient->idade = $request->idade;
        // $registerPatient->tipoIdade = $request->tipoIdade;
        // $registerPatient->procedencia = $request->procedencia;

        // //Image Upload
        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     $requestImage = $request->image;
        //     $extension = $requestImage->extension();
        //     $imageName = md5($requestImage->getClientOriginalname() . strtotime("now") . '.' . $extension);
        //     $requestImage->move(public_path('img/fichas'), $imageName);
        //     $registerPatient->image = $imageName;
        // };

        // $registerPatient->save();

        // return redirect('/dashboard')->with('msg', 'Registro inserido com sucesso!');
    }

    public function index()
    {

        try {
            $patients = $this->patientsServices->index();
            dd($patients);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json($patients, 200);
        // $animalsDetails = Patient::findOrFail($id);

        // $cardOwner = User::where('id', $animalsDetails->user_id)->first()->toArray();

        // return view('fichaTecnica.show', ['animalsDetails' => $animalsDetails, 'cardOwner' => $cardOwner]);
    }

    public function show(string $id)
    {
        try {
            $patient = $this->patientsServices->findOne($id);
        } catch (Exception $e) {
            return $e;
        }
        return response()->json($patient, 200);
    }

    public function delete($id)
    {
        try {
            $patient = $this->patientsServices->delete($id);
        } catch (Exception $e) {
            throw new Exception($e);
        }

        return response()->json($patient, 200);
        // Patient::findOrFail($id)->delete();

        // return redirect('/dashboard')->with('msg', 'Registro excluído com sucesso!');
    }

    // public function edit($id)
    // {
    //     try {
    //         $patient = $this->patientsServices->update($id);
    //     } catch (Exception $e) {
    //         return $e;
    //     }
    
    //     return response()->json($patient, 200);

    //     // $animalsDetails = Patient::findOrFail($id);

    //     // return view('fichaTecnica.edit', ['registros' => $animalsDetails]);
    // }

    public function update(Request $request)
    {

        try {
            $patient = $this->patientsServices->update(new UpdatePatientDTO($request));
        } catch (Exception $e) {
            throw new Exception("Não foi possível atualizar cadastro" . $e);
        }
        return response()->json($patient, 200);
        // $data = $request->all();

        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     $requestImage = $request->image;
        //     $extension = $requestImage->extension();
        //     $imageName = md5($requestImage->getClientOriginalname() . strtotime("now") . '.' . $extension);
        //     $requestImage->move(public_path('img/fichas'), $imageName);
        //     $data['image'] = $imageName;
        // };

        // Patient::findOrFail($request->id)->update($data);

        // return redirect('/dashboard')->with('msg', 'Registro alterado com sucesso!');
    }
}
