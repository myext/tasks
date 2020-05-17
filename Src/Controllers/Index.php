<?php

namespace Controllers;

use Db\Task;
use Db\DB;
use Exceptions\NotFoundException;

class Index
{
    protected $model;

    public function __construct()
    {
        $this->model = Task::class;
        $this->model::setPdo(DB::getPDO());
    }

    public function home()
    {
        $data = $this->model::paginate();

        return view($data, 200, 'home');
    }

    public function paginate( $request, $params )
    {
        $data = $this->model::paginate( $params['page'] );

        if($data) return view($data, 200, 'home');

        throw new NotFoundException;
    }




}