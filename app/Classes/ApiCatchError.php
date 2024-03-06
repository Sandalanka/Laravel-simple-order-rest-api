<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiCatchError{
     
    public static function rollback($e, $message="Something went wrong! Process not completed"){
        DB::rollBack();
        self::throw($e, $message);

    }

    public static function throw($e, $message="Something went wrong! Process not completed"){
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }
}