<?php

namespace App\Exceptions;

use Exception;

Class AuthFailedException extends Exception 
{
    public function render() {
        return response()->json([
            'message' => 'These Credentials do not match our records. '
        ], 422);
    }
}