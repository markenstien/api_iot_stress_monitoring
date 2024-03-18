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
