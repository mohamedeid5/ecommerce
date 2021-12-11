<?php

namespace App\Traits;

trait RespondsWithHttpStatus
{

    /**
     * Method success
     *
     * @param $message
     * @param $data $data
     * @param $status
     * @return void
     */
    protected function success($message, $data = [], $status = 200)
    {
        return response([
            'sucess' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * Method failure
     *
     * @param $message
     * @param $status
     *
     * @return void
     */
    protected function failure($message, $status = 422)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

}
