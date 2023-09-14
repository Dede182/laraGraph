<?php

if(!function_exists(('datamsg'))){
    function datamsg($data = [],int $status = 200,array $headers = array(),int $options = 0){

        return response()->json($data, $status,$headers, $options);
    }
}

