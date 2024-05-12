<?php 
    namespace App\Controllers;

use App\Models\DeviceModel;

    class DeviceController extends Controller {
        private $modelDevice;
        public function __construct()
        {
            parent::__construct();
            $this->modelDevice = new DeviceModel();
        }

        /**
         * get all devices
         */
        public function index() {
            echo 'test';
        }

        /**
         * open device
         * req: code
         */
        public function open() {
            $code = request()->params('code');

            if(!empty($code)) {
                $resp = $this->modelDevice->open($code);
                echo $this->apiResponse([
                    'message' => $this->modelDevice->getMessageString(),
                    'success' => $resp ? 'TURNED ON' : 'ERROR',
                    'device'  => $this->modelDevice->getRetval('device')
                ]);
            } else {
                echo $this->apiResponse([
                    'message' => 'Invalid Request device code not specified',
                    'success' => 'ERROR'
                ]);
            }
        }

        /**
         * close device
         */
        public function close() {
            $code = request()->params('code');

            if(!empty($code)) {
                $resp = $this->modelDevice->close($code);
                echo $this->apiResponse([
                    'message' => $this->modelDevice->getMessageString(),
                    'success' => $resp ? 'TURNED ON' : 'ERROR',
                    'device'  => $this->modelDevice->getRetval('device')
                ]);
            } else {
                echo $this->apiResponse([
                    'message' => 'Invalid Request device code not specified',
                    'success' => 'ERROR',
                ]);
            }
        }

        public function toggle() {
            $code = request()->params('code');
            if(!empty($code)) {
                $resp = $this->modelDevice->toggle($code);
                echo $this->apiResponse([
                    'message' => $this->modelDevice->getMessageString(),
                    'success' => $resp ? 'TURNED ON' : 'ERROR',
                    'device'  => $this->modelDevice->getRetval('device')
                ]);
            } else {
                echo $this->apiResponse([
                    'message' => 'Invalid Request device code not specified',
                    'success' => 'ERROR',
                ]);
            }
        }

        /**
         * fetch devices to check which are open or close
         */
        public function fetchDevices() {
            echo $this->apiResponse([
                'message' => 'Devices',
                'devices' => $this->modelDevice->all()
            ]);
        }

        /**
         * pass device code
         */
        public function getDeviceStatus() {
            $deviceCode = request()->get('device_code');
            $device = $this->modelDevice->getByCode($deviceCode);

            echo parent::apiResponse([
                'deviceCode' => $deviceCode,
                'device' => $device
            ]);
        }
    }