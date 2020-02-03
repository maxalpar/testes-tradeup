<?php

use Symfony\Component\HttpFoundation;

Route::get('/', function () {
    return Response::json(['System' => 'TradeUp API', 'message' => 'Wellcome'],
        HttpFoundation\Response::HTTP_OK);
});

Auth::routes();


