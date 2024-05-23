<?php
    namespace App\Controllers;
    use App\Controllers\Controller;
    use App\Models\SensorResponseModel;

    class SensorResponseController extends Controller{
        private $modelSensorResponse;

        public function __construct()
        {
            parent::__construct();
            $this->modelSensorResponse = new SensorResponseModel();
        }

        /**
         * store sensor data using get
         */
        public function store() {
            $pulseRateData = request()->params('pulserate');
            $temperatureData = request()->params('temperature');
            $heartbeatData = request()->params('hearbeat');

            /**
             * convert each items to array
             */

            $pulseRateDataArray = explode(',', $pulseRateData);
            $temperatureDataArray = explode(',', $temperatureData);
            $heartbeatDataArray = explode(',', $heartbeatData);

            // $pulseRateDataArray = array_walk($pulseRateDataArray, 'trim');
            // $temperatureDataArray = array_walk($temperatureDataArray, 'trim');
            // $heartbeatDataArray = array_walk($heartbeatDataArray, 'trim');


            
            $resp = $this->modelSensorResponse->addPassOne([
                'pulseRate' => $pulseRateDataArray,
                'bodyTemp'   => $temperatureDataArray,
                'gsr'    => $heartbeatDataArray
            ]);

            if($resp) {
                echo $this->apiResponse([
                    'entryStatus' => $resp,
                    'message' => 'Censor Data Stored'
                ]);
            } else {
                echo $this->apiResponse([
                    'message' => 'something weng wroing'
                ]);
            }
        }
        /**
         * POST
         * payload = q
         * q keys = pulseRate, bodyTemp, gs
         */
        public function index() {
            if(parent::isSubmitted()) {
                $params = request()->params('q');
                $resp = $this->modelSensorResponse->addPassOne($params);

                if($resp) {
                    echo $this->apiResponse([
                        'entryStatus' => $resp,
                        'message' => 'Censor Data Stored'
                    ]);
                } else {
                    echo $this->apiResponse([
                        'message' => 'something weng wroing'
                    ]);
                }
            } else {
                $sensorDatas = $this->modelSensorResponse->all();
                echo $this->apiResponse([
                    'message' => 'sensor datas',
                    'data' => $sensorDatas
                ]);
            }
        }

        /**
         * GET
         */
        public function show($id) {
            $responseData = $this->modelSensorResponse->getById($id);
            $response = $this->modelSensorResponse->converetSensorData([$responseData]);

            if($response) {
                $resp = $this->apiResponse([
                    'message' => 'sensor data',
                    'sensorData' => $response
                ]);

                return $resp;
            }

            return false;
        }


        public function fetchSensorDataOnly($id) {
            $responseData = $this->modelSensorResponse->getById($id);
            $response = $this->modelSensorResponse->converetSensorData([$responseData]);
            $responseDataConverted = $response[0];

            
            echo $this->apiResponse([
                'message' => 'response data',
                'sensorData' => $responseDataConverted->response_data
            ]);
        }

        /**
         *recent entry
         */
        public function recent() {
            echo $this->apiResponse([
                'message' => 'Recent Data',
                'sensorData' =>$this->modelSensorResponse->getLast()
            ]);
        }
    }