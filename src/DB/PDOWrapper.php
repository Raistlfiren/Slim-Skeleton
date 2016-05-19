<?php


namespace App\DB;

use Aura\SqlQuery\QueryFactory;
use PDO;

class PDOWrapper extends PDO
{

    protected $queryFactory;

    public function __construct($dsn, $username, $passwd, $options, QueryFactory $queryFactory)
    {
        parent::__construct($dsn, $username, $passwd, $options);

        $this->queryFactory = $queryFactory;
    }

    public function select()
    {
        return $this->queryFactory->newSelect();
    }

    public function insert()
    {
        return $this->queryFactory->newInsert();
    }

    public function update()
    {
        return $this->queryFactory->newUpdate();
    }

    public function delete()
    {
        return $this->queryFactory->newDelete();
    }
}
