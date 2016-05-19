<?php


namespace App\Repository;

use Aura\SqlQuery\Common\DeleteInterface;
use Aura\SqlQuery\Common\InsertInterface;
use Aura\SqlQuery\Common\SelectInterface;
use Aura\SqlQuery\Common\UpdateInterface;
use Monolog\Logger;
use PDOException;
use Slim\PDO\Database;
use App\DB\PDOWrapper;

class AbstractRepository
{
    /** @var Database $db */
    protected $db;

    /** @var Logger $logger */
    protected $logger;

    public function __construct(PDOWrapper $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    public function fetchResults(SelectInterface $select)
    {
        $result = null;

        $stmt = $select->getStatement();

        try {
            $statement = $this->db->prepare($stmt);
            $statement->execute($select->getBindValues());
            $result = $statement->fetchAll();
        } catch (PDOException $e) {
            $this->logger->error($select->__toString());
            $this->logger->error($e->getMessage());
            return null;
        }

        return $result ?: null;
    }

    public function fetchResult(SelectInterface $select)
    {
        $result = null;

        $stmt = $select->getStatement();

        try {
            $statement = $this->db->prepare($stmt);
            $statement->execute($select->getBindValues());
            $result = $statement->fetch();
        } catch (PDOException $e) {
            $this->logger->error($select->__toString());
            $this->logger->error($e->getMessage());
            return null;
        }

        return $result ?: null;
    }

    public function updateResult(UpdateInterface $update)
    {
        $result = null;

        $stmt = $update->getStatement();

        try {
            $statement = $this->db->prepare($stmt);
            $result = $statement->execute($update->getBindValues());
        } catch (PDOException $e) {
            $this->logger->error($update->__toString());
            $this->logger->error($e->getMessage());
            return null;
        }

        return $result;
    }

    public function insertResult(InsertInterface $insert)
    {
        $result = null;

        $stmt = $insert->getStatement();

        try {
            $statement = $this->db->prepare($stmt);
            $statement->execute($insert->getBindValues());
        } catch (PDOException $e) {
            $this->logger->error($insert->__toString());
            $this->logger->error($e->getMessage());
            return null;
        }

        return $this->db->lastInsertId();
    }

    public function deleteResult(DeleteInterface $delete)
    {
        $result = null;

        $stmt = $delete->getStatement();

        try {
            $statement = $this->db->prepare($stmt);
            $result = $statement->execute($delete->getBindValues());
        } catch (PDOException $e) {
            $this->logger->error($delete->__toString());
            $this->logger->error($e->getMessage());
            return null;
        }

        return $result;
    }
}
