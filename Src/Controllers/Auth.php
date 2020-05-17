<?php


namespace Controllers;

use Session\Session;

class Auth extends Controller
{
    public function login()
    {
        return view([], 200, 'login');

    }

    public function check( $request )
    {
        if(Session::isAuth()){
            Session::setMessages('Вы уже вошли');
            header('Location: '.$request->getServerParams()['HTTP_REFERER']);
            exit;
        }

        $data = $request->getParsedBody();

        if(password_verify(trim($data['login']).trim($data['password']), config("hash"))){
            Session::auth();
            Session::setMessages('Вы вошли');
        } else {
            Session::setErrors('Неверная пара логин - пароль');
        }

        header('Location: '.$request->getServerParams()['HTTP_REFERER']);
        exit;
    }

    public function logout($request)
    {
        if(Session::isAuth()){

            Session::logOut();
            Session::setMessages('Вы вышли');
        }
        header('Location: '.$request->getServerParams()['HTTP_REFERER']);
        exit;
    }

}