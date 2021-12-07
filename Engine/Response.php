<?php

namespace Engine;

class Response
{
    public static function send($res, $status = 200): void
    {
        if (is_array($res)) {
            header('Content-Type: Application/json');
            $res = json_encode($res);
        }

        echo $res;
        die($status);
    }

    public static function redirect($url): void
    {
        header("Location: $url");
        die();
    }
}