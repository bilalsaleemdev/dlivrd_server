<?php

function jsonErrorResponse($status, $code, $errors){
    return response()->json([
        'status' => $status,
        'errors' => $errors
    ], $code);
}

function jsonSuccessResponse($status, $code, $messages){
    return response()->json([
        'status' => $status,
        'info' => $messages
    ], $code);
}

?>

