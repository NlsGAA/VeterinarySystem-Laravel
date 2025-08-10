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
        try {
            $owners = $this->ownersServices->index();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Registros recuperados com sucesso!", $owners);
    }

    public function update(Request $request)
    {
        try {
            $this->ownersServices->update($request);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Cadastro atualizado com sucesso!", null);
    }

    public function delete(string $id)
    {
        try {
            $this->ownersServices->delete($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Tutor deletado com sucesso!", null);
    }

}
