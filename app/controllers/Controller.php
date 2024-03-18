<?php

namespace App\Controllers;

/**
 * This is the base controller for your Leaf MVC Project.
 * You can initialize packages or define methods here to use
 * them across all your other controllers which extend this one.
 */
class Controller extends \Leaf\Controller
{
    public function isSubmitted() {
        return request()->typeIs('post');
    }

    public function apiResponse($data, $status = true) {
        return response()->json([
            'status' => $status ? 'success' : 'failed',
            'data' => $data,
        ]);
    }
}
