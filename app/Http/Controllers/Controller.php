<?php

namespace App\Http\Controllers;

abstract class Controller
{
     public const HTTP_OK = 200;
     public const HTTP_BAD_REQUEST = 400;
     public const HTTP_UNPROCESSABLE_ENTITY = 422;
     public const HTTP_INTERNAL_SERVER_ERROR = 500;
     public const HTTP_CREATED = 201;
}
