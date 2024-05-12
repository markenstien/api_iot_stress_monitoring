<?php
app()->setNamespace('App\Controllers');

db()->autoConnect();

app()->get('/', function () {
    response()->json(['message' => 'Congrats!! You\'re on Leaf API']);
});

app()->group('/api/v1/user', function(){
   $controller = 'UserController';
   app()->get('/', "{$controller}@index");
   app()->post('/register', "{$controller}@register");
   app()->post('/authenticate', "{$controller}@authenticate");
   app()->get('/{id}', "{$controller}@get");
});


 app()->group('/api/v1/sensor-data', function(){
    $controller = 'SensorResponseController';
    app()->get('/', "{$controller}@index");
    app()->post('/', "{$controller}@index");
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
    app()->get('/toggle', "{$controller}@toggle");
 });

 app()->group('/api/v1/sensor-device', function() {
    $controller = 'SensorsController';
    app()->get('/status', "{$controller}@status");
    app()->get('/start', "{$controller}@start");
    app()->get('/stop', "{$controller}@stop");
 });