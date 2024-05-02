<?php
    namespace App\Models;
    use App\Models\Model;

    class SensorDeviceModel extends Model {

        public $table = 'sensor_device';
        public $timestamps = false;

        public function start() {
            $device = SensorDeviceModel::find(1);
            $device->is_on = true;
            $device->save();

            return true;
        }

        public function end() {
            $device = SensorDeviceModel::find(1);
            $device->is_on = false;
            $device->save();

            return true;
        }
        
        public function status() {
            $resp = parent::find(1);
            if($resp->is_on == true) {
                return 'HIGH';
            }
            return 'LOW';
        }
    }