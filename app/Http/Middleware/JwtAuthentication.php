<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class JwtAuthentication
{
    public function handleErrorRedirection(string $errorMessage, int $errorCode)
    {
        return response()->json($errorMessage, $errorCode);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorizationHeader = explode(" ", $request->header("Authorization"));

        if ($authorizationHeader[0] !== "Bearer") {
            throw new \Exception("Authorization type mismatch."); 
        }

        $key = env("APP_KEY", false); 

        if (!$key) {
            return $this->handleErrorRedirection("Internal Server Error", 500);
        }

        $algorithm = env("JWT_ALGORITHM", false);

        if (!$jwtAlgorithm) {
            return $this->handleErrorRedirection("Internal Server Error", 500);
        }

        $authorizationToken = $authorizationHeader[1];
        $jwtToken = Crypt::decryptString($authorizationToken);

        try {
            $decoded = JWT::decode($jwtToken, $key, $algorithm);
        } catch (BeforeValidException | ExpiredException | SignatureInvalidException $exception) {
            return $this->handleErrorRedirection("Unauthorized", 401);
        }

        return $next($request);
    }
}
