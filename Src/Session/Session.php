<?php


namespace Session;


class Session
{
    public static function setMessages( $messages)
    {
        if(is_array($messages)) array_merge ( $_SESSION["messages"], $messages);
        else $_SESSION["messages"][] = $messages;
    }

    public static function setErrors( $errors )
    {
        if(is_array($errors)) array_merge ( $_SESSION["errors"], $errors);
        else $_SESSION["errors"][] = $errors;
    }

    public static function getErrors()
    {
        $errors = [];
        if(isset($_SESSION["errors"])) {
            $errors = $_SESSION["errors"];
            unset($_SESSION["errors"]);
        }
        return $errors;
    }

    public static function getMessages()
    {
        $messages = [];
        if(isset($_SESSION["messages"])) {
            $messages = $_SESSION["messages"];
            unset($_SESSION["messages"]);
        }
        return $messages;
    }

    public static function auth()
    {
        $_SESSION["auth"] = true;
    }

    public static function logOut()
    {
        unset($_SESSION["auth"]);
    }

    public static function isAuth()
    {
        return key_exists('auth', $_SESSION);
    }

}