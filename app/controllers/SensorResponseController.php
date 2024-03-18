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
            }
        }
    }