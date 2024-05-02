<?php
app()->setNamespace('App\Controllers');

db()->autoConnect();

app()->get('/', function () {
    response()->json(['message' => 'Congrats!! You\'re on Leaf API']);
});


app()->get('/api/v1/sensor-response/', function () {
    response()->json(['message' => 'Send Sensor One minute collected Data -> this will report success response']);
});

app()->post('/api/v1/register', "UserController@register");
app()->post('/api/v1/authenticate', "UserController@authenticate");

/**
 * user route
 */
 app()->get('/api/v1/user/', "UserController@index");
 app()->get('/api/v1/user/{id}', "UserController@get");
 app()->get('/api/v1/sensor-response/sample', "SensorResponseController@sample");


 app()->group('/api/v1/sensor-data', function(){
    $controller = 'SensorResponseController';
    app()->get('/', "{$controller}@index");
    app()->get('/recent', "{$controller}@recent");
    app()->get('/show/{id}', "{$controller}@show");
    app()->get('/show-sensor-data/{id}', "{$controller}@fetchSensorDataOnly");
 });


 app()->group('/api/v1/device', function() {
    $controller = 'DeviceController';
    app()->get('/', "{$controller}@fetchDevices");
    app()->get('/device-status', "{$controller}@getDeviceStatus");
    app()->get('/open', "{$controller}@open");
    app()->get('/close', "{$controller}@close");
 });

 app()->group('/api/v1/sensor-device', function() {
    $controller = 'SensorsController';
    app()->get('/status', "{$controller}@status");
    app()->get('/start', "{$controller}@start");
    app()->get('/stop', "{$controller}@stop");
 });