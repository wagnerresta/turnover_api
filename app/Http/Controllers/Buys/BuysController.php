<?php

namespace App\Http\Controllers\Buys;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buys\BuysStoreRequest;
use App\Models\Buys;
use App\Services\BuysService;

class BuysController extends Controller
{
    private $buysService;

    public function __construct()
    {
        $this->buysService = new BuysService();
    }

    public function buyStore(BuysStoreRequest $request, Buys $buy){

        return $this->buysService->makeBuy($buy,$request);
        
    }
}
teste de branch
testando a branch 02
NOVA LINHA DE TESTE