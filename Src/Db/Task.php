<?php


namespace Db;

use \PDO;


class Task
{
    protected static $fields = ['id', 'name', 'email', 'text', 'is_done', 'is_censored'];
    protected static $table = "tasks";
    protected static $perPage = 3;
    protected static $pdo;
    protected $data = [
        'is_done' => 0,
        'is_censored' => 0,
    ];

    public static function setPdo( $pdo )
    {
        self::$pdo = $pdo;
    }

    public static function id($id)
    {
        $query = "SELECT * FROM ".self::$table." WHERE `id` = {$id}";

        $stmt = self::$pdo->query($query);

        $data = $stmt->fetch();

        if($data){

            $task = new self();

            $task->data = $data;

            return $task;
        }
        return false;
    }

    public static function count()
    {

        $stmt = self::$pdo->query("SELECT COUNT(*) FROM ".self::$table);

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public static function paginate( $page = 1 )
    {
        $count = self::count();

        $start = ((int) $page  - 1 ) * self::$perPage;

        $num = $count / self::$perPage;

        $last = $num > (int) $num ? (int) $num + 1 : (int) $num;

        if( $page > $last ) return null;

        $query = "SELECT * FROM ".self::$table." ORDER BY id DESC LIMIT {$start} ,".self::$perPage;

        $stmt = self::$pdo->query($query);

        return ["collection" => $stmt->fetchall(),
            "pages" => [
                "current" => $page,
                "last" => $last
            ]
        ];
    }

    public function __set ( string $name , $value )
    {
        if (in_array($name, self::$fields)) {

            $this->data[$name] = $value;
        }
    }

    public function __get ( string $name  )
    {
        if (in_array($name, self::$fields)) return $this->data[$name] ;

        return null;
    }

    public function create( $data )
    {
        $this->data = array_merge($this->data, $data);

        $this->save();
    }

    public function save()
    {
        $fields = self::$fields;

        $id_key = array_search('id', $fields);

        if(!array_key_exists('id', $this->data)) unset($fields[$id_key]);

        $names =  trim(implode( ', ' , $fields));


        $placeholders = ":".trim(implode( ', :' , $fields));

        $on_duplicate = array_map(function ($n){
            return "{$n} = VALUES({$n})";
        }, $fields);

        $on_duplicate = trim(implode( ', ' , $on_duplicate));

        $query = "INSERT INTO ".self::$table." ({$names}) VALUES($placeholders)
        ON DUPLICATE KEY UPDATE {$on_duplicate}";

        $stm = self::$pdo->prepare($query);
        $stm->execute($this->data);

        $query  = self::$pdo->query("SELECT LAST_INSERT_ID()");
        $id = $query->fetchColumn();

        return $id;
    }
}