<?php
    namespace App\Controllers;
    /**
     * this class will fetch
     * if someone is requesting for sensordata
     * only then the fetching of sensor data will be accepted
     */
    use App\Controllers\Controller;
    use App\Models\SensorDeviceModel;

    class SensorsController extends Controller {
        private $modelSensorDevice;

        public function __construct()
        {
            parent::__construct();
            $this->modelSensorDevice = new SensorDeviceModel();
        }
        
        public function start() {
            $this->modelSensorDevice->start();
            echo parent::apiResponse([
                'message' => 'Sensor Started',
                'action' => 'Start'
            ]);
        }

        public function stop() {
            $this->modelSensorDevice->end();
            echo parent::apiResponse([
                'message' => 'Sensor Ended',
                'action' => 'End'
            ]);
        }

        public function status() {
            $sensorDataStatus = $this->modelSensorDevice->status();
            echo parent::apiResponse([
                'message' => $sensorDataStatus
            ]);
        }
    }