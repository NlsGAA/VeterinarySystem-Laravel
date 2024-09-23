<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OwnersServices;
use Illuminate\Http\Request;

class OwnersController extends Controller
{
    public function __construct(
        private OwnersServices $ownersServices
    ){}

    public function index()
    {
        return $this->ownersServices->index();
    }

    public function update(Request $request)
    {
        try {
            $this->ownersServices->update($request);
        } catch (\Exception $e) {
            return 'Erro ao atualizar dono' . $e;
        }
        
        return response()->json([
            'message' => 'Cadastro atualizado com sucesso!',
        ], 200);
    }

    public function delete(string $id)
    {
        try {
            $this->ownersServices->delete($id);
        } catch (\Exception $e) {
            return 'Não foi possível deletar dono';
        }

        return response()->json([
            'message' => 'Dono deletado com sucesso!',
        ], 200);
    }

}
