<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\ApiMainController;

class MenuController extends ApiMainController
{
    public function getAllMenu()
    {

        $data = [
            'success' => true,
            'data' => $this->fullMenuLists,
        ];
        return response()->json($data);
    }

    public function addPartnerMenu()
    {


    }


}
