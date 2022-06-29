<?php

namespace app\core;

class Respone
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
