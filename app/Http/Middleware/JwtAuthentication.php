<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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
            return $this->handleErrorRedirection("APP_KEY env variable is missing", 500);
        }

        $algorithm = env("JWT_ALGORITHM", false);

        if (!$algorithm) {
            return $this->handleErrorRedirection("JWT_ALGORITHM env variable is missing", 500);
        }
        
        try {
            $jwtToken = Crypt::decryptString($authorizationHeader[1]);
            $decoded = JWT::decode($jwtToken, $key, [$algorithm]);
        } catch (BeforeValidException | SignatureInvalidException $exception) {
            return $this->handleErrorRedirection("Unauthorized", 401);
        } catch (ExpiredException $exception) {
            return $this->handleErrorRedirection("Token expired", 498);
        } catch (DecryptException $exception) {
            return $this->handleErrorRedirection("Invalid token payload", 498);
        }

        try {
            $user = User::findOrFail($decoded->data->id);
        } catch (Exception $exception) {
            return response()->json("User not found", 404);
        }

        $request->merge(["USER_ROLE" => $user->role]);
        $request->merge(["USER_ID" => $user->id]);

        return $next($request);
    }
}
