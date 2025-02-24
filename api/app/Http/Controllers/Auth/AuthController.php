<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PersonalBearierTokens;
use App\Models\PersonalAccessTokens;
use DateTime;

class AuthController extends BaseController
{
    protected $bearier = '@rekAPP';

    // Register api
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken($this->bearier)->plainTextToken;
        $success['name'] =  $user->name;

        // Insert Token Bearier Baru
        $break = explode('|',$success['token']);
        PersonalBearierTokens::create([
            'user_id' => $user->id,
            'access_token_id' => $break[0],
            'token' => $break[1]
        ]);

        return $this->sendResponse($success, 'User register successfully.');
    }

    // Login api
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            // Remove Prev Token
            PersonalBearierTokens::where('user_id',$user->id)->where('is_active',1)->update(['is_active' => 0]);
            PersonalAccessTokens::where('name',$this->bearier)->where('tokenable_id',$user->id)->whereNull('expires_at')->update(['expires_at'=>now()]);
            
            $success['token'] =  $user->createToken($this->bearier)->plainTextToken;
            $success['name'] =  $user->name;

            // Insert Token Bearier Baru
            $break = explode('|',$success['token']);
            PersonalBearierTokens::create([
                'user_id' => $user->id,
                'access_token_id' => $break[0],
                'token' => $break[1]
            ]);

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function forget(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::where('email',$request->email)->first();
        if($user){
            // Insert Token Bearier
            $dateNow = new DateTime('now');
            PasswordResetTokens::where('email',$request->email)->delete();
            $resetToken = PasswordResetTokens::create([
                'email' => $request->email,
                'token' => bcrypt($request->email.time()),
                'expired_at' => $dateNow->modify('+1 day')->format('Y-m-d H:i:s'),
            ]);

            // Todo: Send Email
            // $user->sendPasswordResetNotification($user->email);
            return $this->sendResponse($resetToken, 'Password reset link has been sent to your email.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function getResetToken(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $token = PasswordResetTokens::where('token',$request->token)->first();
        if($token){
            if($token->expired_at < date('Y-m-d H:i:s')){
                return $this->sendError('Token Expired.', ['error'=>'Token Expired']);
            }

            // Todo: Send Email
            // $user->sendPasswordResetNotification($user->email);
            return $this->sendResponse($token, 'Create New Password.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $token = PasswordResetTokens::where('token',$request->token)->first();
        if($token){
            if($token->expired_at < date('Y-m-d H:i:s')){
                return $this->sendError('Token Expired.', ['error'=>'Token Expired']);
            }

            $password = bcrypt($request->password);
            $user = User::where('email',$token->email)->first();
            $user->update(['password'=>$password]);

            // Remove Prev Token
            PasswordResetTokens::where('email',$token->email)->delete();
            PersonalBearierTokens::where('user_id',$user->id)->where('is_active',1)->update(['is_active' => 0]);
            PersonalAccessTokens::where('name',$this->bearier)->where('tokenable_id',$user->id)->whereNull('expires_at')->update(['expires_at'=>now()]);
            
            $success['token'] =  $user->createToken($this->bearier)->plainTextToken;
            $success['name'] =  $user->name;

            // Insert Token Bearier Baru
            $break = explode('|',$success['token']);
            PersonalBearierTokens::create([
                'user_id' => $user->id,
                'access_token_id' => $break[0],
                'token' => $break[1]
            ]);

            // Todo: Send Email
            // $user->sendPasswordResetNotification($user->email);
            return $this->sendResponse($success, 'Password Changed.');
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function authLogin(Request $request): JsonResponse
    {
        return $this->sendResponse([], 'Please Login First.');
    }   

    public function authLogout(Request $request): JsonResponse
    {
        $user = PersonalBearierTokens::where('token',$request->bearerToken())->first();
        if($user){
            PersonalBearierTokens::where('user_id',$user->user_id)->where('is_active',1)->update(['is_active' => 0]);
            PersonalAccessTokens::where('name',$this->bearier)->where('tokenable_id',$user->user_id)->whereNull('expires_at')->update(['expires_at'=>now()]);
        }
        return $this->sendResponse([], 'User logout successfully.');
    }   

}