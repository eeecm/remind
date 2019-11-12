<?php

namespace Encore\Remind\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class RemindController extends Controller
{
    public function index(Content $content)
    {
        $socket=env('SOCKET_URL','');
        return $content
            ->title('提示')
            ->description('消息提示')
            ->body(view('remind::index')->with(['socket_url'=>$socket]));
    }
}