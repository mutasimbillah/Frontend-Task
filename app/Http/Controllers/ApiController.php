<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends BaseController {
    /**
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = null, $message = "Success", $status = 200, $success = true) {
        $response = array(
            'success' => $success,
            'message' => $message,
        );

        if (isset($data->resource) && $data->resource instanceof AbstractPaginator) {
            $data = $data->resource->toArray();
        } else if (!($data instanceof LengthAwarePaginator)) {
            $data = compact('data');
        } else {
            //TODO ->toArray()
            $data = $data;
        }
        $response += $data;
        return new JsonResponse($response, $status);
    }

    /**
     * Send a failure response
     * @param null $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function failed($data = null, $message = "Failed", $status = 400) {
        return $this->success($data, $message, $status, false);
    }

    /**
     * Send an unauthorized response
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized() {
        return $this->failed(null, 'Unauthorized', 401);
    }

    /**
     * Helper functions for api controllers
     */
    /**
     * Get the api auth instance
     *
     * @return JwtGuard
     */
    protected function auth() {
        return Auth::guard('api');
    }

    /**
     * @return User|null
     */
    protected function user() {
        return $this->auth()->user();
    }

    /**
     * @return int|string
     */
    protected function userId() {
        return $this->auth()->id();
    }

    /**
     * @param int $default
     * @return int
     */
    protected function limit($default = 5) {
        return (int) request()->input('limit', $default);
    }
}
