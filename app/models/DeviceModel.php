<?php 
    namespace App\Models;
    class DeviceModel extends Model {
        public $table = 'devices';
        public $timestamps = false;

        const DEVICE_A = 'HUMIDA';
        const DEVICE_B = 'HUMIDB';
        const DEVICE_C = 'HUMIDC';

        public function open($deviceCode) {
            $device = $this->getByCode($deviceCode);

            if(!$device) {
                $this->addMessage("No device found with code {$deviceCode}");
                return false;
            } else {
                $this->addRetval('device', $device);
                if($device->device_status == 'LOW') {
                    $device->remarks = 'Device has been turned on date: '.tick()->format('YYYY-MM-DD');
                    $device->device_status = 'HIGH';
                    $device->save();
                    $this->addMessage("Device {$device->device_name} has been turned on");
                    return true;
                } else {
                    $this->addMessage("Device {$device->device_name} is currently turned on");
                    return false;
                }
            }

        }

        /**
         * close device
         */
        public function close($deviceCode) {
            $device = $this->where('device_code', $deviceCode)->first();

            if(!$device) {
                $this->addMessage("No device found with code {$deviceCode}");
                return false;
            } else {
                $this->addRetval('device', $device);
                if($device->device_status == 'HIGH') {
                    $device->remarks = 'Device has been turned off date: '.tick()->format('YYYY-MM-DD');
                    $device->device_status = 'LOW';
                    $device->save();
                    $this->addMessage("Device {$device->device_name} has been turned off");
                    return true;
                } else {
                    $this->addMessage("Device {$device->device_name} is currently turned off");
                    return false;
                }
            }
        }

        public function toggle($code) {
            $device = $this->getByCode($code);

            if(!$device) {
                return false;
            }

            if($device->device_status == 'LOW') {
                return $this->open($code);
            } else {
                return $this->close($code);
            }
        }

        public function getByCode($code) {
            return $this->where('device_code', $code)->first();
        }

        public function getDevices() {
            return [
                self::DEVICE_A,
                self::DEVICE_B,
                self::DEVICE_C,
            ];
        }
    }