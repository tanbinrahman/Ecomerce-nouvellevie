<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getUserTempId(){

    if(!session()->has('USER_TEMP_ID')){

        $rand =rand(111111111 ,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
    }else{
        return session()->get('USER_TEMP_ID');
    }
    
}
?>