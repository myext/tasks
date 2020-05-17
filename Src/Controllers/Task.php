<?php


namespace Controllers;


use Db\DB;
use Db\Task as Model;
use Exceptions\UnauthorizedException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Session\Session;

class Task extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = \Db\Task::class;
        $this->model::setPdo(DB::getPDO());
    }

    public function new()
    {

        return view([], 200, 'new');
    }

    public function post( $request )
    {
        $data = $request->getParsedBody();

        $validate = $this->postValidate($data);

        if($validate === true){

            $task = new Model();

            $task->create($data);

            Session::setMessages('Задача добавлена');

            header('Location: http://'.$_SERVER['SERVER_NAME']);
            exit;
        }

        Session::setErrors($validate);

        header('Location: '.$request->getServerParams()['HTTP_REFERER']);
        exit;
    }

    public function done( $request )
    {
        if(!Session::isAuth()) throw new UnauthorizedException;

        $data = $request->getParsedBody();

        if(key_exists('id', $data) and key_exists('is_done', $data)) {

            $task = Model::id($data['id']);

            if ($task){

                if($data['is_done'] == 'on') $task->is_done = 1;
                else $task->is_done = 0;

                $task->save();

                return view(['message' => 'задача обновлена'], 200, 'default');
            }
        }
        return view([], 200, 'default');
    }

    public function update( $request )
    {
        if(!Session::isAuth()) throw new UnauthorizedException;

        $data = $request->getParsedBody();

        if(key_exists('id', $data) and key_exists('text', $data)) {

            $task = Model::id($data['id']);

            if ($task){

                $new_text = trim($data['text']);

                if($task->text == $new_text) exit;

                $task->text = $new_text;

                $task->is_censored = 1;

                $task->save();

                return view(['message' => 'задача обновлена'], 200, 'default');
            }
        }
        throw new \Exception();
    }



    protected function postValidate( $data )
    {
        try{
            Validator::key('name')->assert($data);
            Validator::key('email')->assert($data);
            Validator::key('text')->assert($data);
            Validator::notEmpty()->assert($data['text']);
            Validator::notEmpty()->assert($data['email']);
            Validator::notEmpty()->assert($data['text']);
            @Validator::email()->assert($data['email']);
        }
        catch(NestedValidationException $ex){

            return implode(" : ", $ex->getMessages([
                'key' => ' Поле должно быть',
                'notEmpty' => "Пустые поля недопустимы",
                'email' => 'Неверное поле email'
                ])
            );
        }
        return true;
    }

}