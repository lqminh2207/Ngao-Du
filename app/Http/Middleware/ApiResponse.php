<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use App\Libraries\JsonResponseBuilder;

class ApiResponse
{
    /**
     *- Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $response = $next($request);
        $original = $response->getOriginalContent();

        $all = $response->headers->all();
        $request_all = $request->all();

        if (!empty($all['message']) && current($all['message']) === true) {
            // dd($response->headers->all());
        }
        // $content = $original->getContent();
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $code = $response->getStatusCode();
            if (isset($original['code'])) {
                $code = $original['code'];
            }
            $message = __('api.http_error');
            if (!empty($original['message'])) {
                $message = $original['message'];
            }

            if($code == 422){
                $message = array_values($original['errors'])[0];
                $message = $message[0];
            }

            $original = JsonResponseBuilder::errorWithMessageAndData($code, $message, $original);
        } else {
            $original = JsonResponseBuilder::success($original);
        }

        $response->setContent($original->getContent());

        return $response;
    }
}
