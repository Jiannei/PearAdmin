<?php

namespace Jiannei\LayAdmin\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends \Illuminate\Routing\Controller
{
    use ValidatesRequests;
}