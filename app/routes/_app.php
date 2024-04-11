<?php
app()->setNamespace('App\Controllers');

db()->autoConnect();

app()->get('/', function () {
    response()->json(['message' => 'Congrats!! You\'re on Leaf API']);
});


app()->get('/api/v1/sensor-response/', function () {
    response()->json(['message' => 'Send Sensor One minute collected Data -> this will report success response']);
});

app()->post('/api/v1/sensor-response-post', "SensorResponseController@index");
app()->post('/api/v1/register', "UserController@register");
app()->post('/api/v1/authenticate', "UserController@authenticate");

app()->get('/api/v1/sensor-response/{id}/show', "SensorResponseController@show");
app()->get('/api/v1/sensor-response/{id}/sensor-data-only', "SensorResponseController@fetchSensorDataOnly");

/**
 * user route
 */

 app()->get('/api/v1/user/{id}', "UserController@get");
 app()->get('/api/v1/sensor-response/sample', "SensorResponseController@sample");