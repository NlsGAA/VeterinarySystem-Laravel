<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TypeServices;
use Illuminate\Support\Facades\Request;
use InvalidArgumentException;

class TypesController extends Controller
{
    private $type;

    public function __construct(
        private TypeServices $typeServices,
        private Request $request
    ) {
        $removeWords = '/api/types/';

        $uri = Request::getPathInfo();

        $endpoint = str_replace($removeWords, '', $uri);

        $this->type = $endpoint;
    }

    public function index() {
       if (method_exists($this->typeServices, $this->type)) {
           return $this->typeServices->{$this->type}();
       }

       throw new InvalidArgumentException(
        'Method of endpoint does not implemented!'
       );
    }
}
