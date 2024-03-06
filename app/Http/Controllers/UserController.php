<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchError;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Interfaces\UserInterface\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Http\Resources\LoginResource;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\DB;
class UserController extends BaseController
{  
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
       $this->userRepositoryInterface = $userRepositoryInterface; 
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = $this->userRepositoryInterface->getUser();
         return $this->sendResponse(new UserResource($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {    $userDetails =[
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ];
        DB::beginTransaction();
        try{
            $data = $this->userRepositoryInterface->userRegistration($userDetails);
            DB::commit();
            return $this->sendResponse(new UserResource($data),'User Create Successful',201);

        }catch(\Exception $ex){
           return ApiCatchError::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * user login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(UserLoginRequest $request){
        $userLoginDetails =[
            'email'=> $request->email,
            'password'=>$request->password
        ];
        $data = $this->userRepositoryInterface->userLogin($userLoginDetails);
        if(!$data['status']){
            return $this->sendError("Login Fail");
        }
        return $this->sendResponse($data,'User Login Successful',200);
        
    }
    
    /**
     * user logout
     *
     * @return void
     */
    public function logout(){
        $data =$this->userRepositoryInterface->userLogout();
        return $this->sendResponse('User Logout Successful!','',200);
    }
}
