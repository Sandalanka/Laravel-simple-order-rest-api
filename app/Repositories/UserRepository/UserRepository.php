<?php

namespace App\Repositories\UserRepository;
use App\Interfaces\UserInterface\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserRepository implements UserRepositoryInterface {
    
    /**
     * getUser Auth login user details get
     *
     * @return void
     */
    public function getUser(){
       return User::findOrFail(Auth::user()->id);
    }    
    /**
     * User Registration
     *
     * @param  mixed $userDetails
     * @return void
     */
    public function userRegistration(array $userDetails){
       $data =User::create($userDetails);
       $data->assignRole('Customer');

       return $data;
    }
        
    /**
     * User Login
     *
     * @param  mixed $userLoginDetails
     * @return void
     */
    public function userLogin(array $userLoginDetails){
        if(Auth::attempt(['email'=>$userLoginDetails['email'],'password'=>$userLoginDetails['password']])){
            $user =Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['status']=true;
            return $success;
        }else{
            return $success['status']=false;
        }
    }    
    /**
     * User Logout
     *
     * @return void
     */
    public function userLogout(){
        Auth::user()->tokens()->delete();
        return true;
    }
}