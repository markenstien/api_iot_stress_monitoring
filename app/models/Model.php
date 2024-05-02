<?php

namespace App\Models;

/**
 * Base Model
 * ---
 * The base model provides a space to set atrributes
 * that are common to all models
 */
class Model extends \Leaf\Model
{
    protected $messages = [];
    protected $retVal = [];

    public function addMessage($message) {
        array_push($this->messages, $message);
        return $this->messages;
    }

    public function getMessages() {
        return $this->messages;
    }

    public function getMessageString() {
        return implode(',', $this->messages);
    }

    protected function addRetval($key, $value) {
        $this->retVal[$key] = $value;
    }

    public function getRetval($key) {
        return $this->retVal[$key] ?? null;
    }
}
