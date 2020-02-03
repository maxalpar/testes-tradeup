<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api',
    'prefix'    => 'refunds',
], function () {
    $this->get('get', 'RefundsController@get');
    $this->post('create', 'RefundsController@create');
    $this->put('update', 'RefundsController@update');
    $this->delete('delete/{id}', 'RefundsController@delete');
    $this->get('report', 'RefundsController@report');
});
