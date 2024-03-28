<?php 
    namespace App\Models;
    class SensorResponseModel extends Model {
        protected $table = 'sensor_response_data';
        public $timestamps  = false;


        public function addPassOne($sensorData) {
            /**
             * validate sensordata
             */

            $validatedSensorData = $this->validateEncodedSensorData($sensorData);

            if(!$validatedSensorData) {
                return false;
            }

            $sensorData = new SensorResponseModel();
            $sensorData->user_id = 1;
            $sensorData->response_data = $this->encodeOrDecodeData($validatedSensorData);
            $sensorData->entry_date = tick()->format('YYYY-MM-DD HH:mm:ss');

            return $sensorData->save();
        }

        public function getById($id) {
            return parent::where('id', $id)->first();
        }

        public function converetSensorData($sensorData = []) {
            if(!empty($sensorData) && is_array($sensorData)) {
                foreach($sensorData as $key => $row) {
                    dump($this->encodeOrDecodeData($row->response_data, false));
                }
            }
        }
        /**
         * valid keys
         * pulseRate, bodyTemp, gsr
         */
        public function validateEncodedSensorData($sensorData) {
            /**
             * required keys
             */
            $requiredKeys = [
                'pulseRate',
                'bodyTemp',
                'gsr'
            ];

            $sensorKeys = array_keys($sensorData);
            $correctKeyCount = 0;

            foreach($sensorKeys as $key => $row) {
                if(in_array($row, $requiredKeys)) {
                    $correctKeyCount++;
                }
            }
            //valid key
            if($correctKeyCount != 3) {
                //add error unmatched key
                return false;
            }

            return $sensorData;
        }

        private function encodeOrDecodeData($sensorData, $encode = true) {
            if($encode) {
                $sensorData = base64_encode(serialize($sensorData));
            } else {
                $sensorData = unserialize(base64_decode($sensorData));
            }

            return $sensorData;
        }
    }