<?php

class MySQLConnection
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var PDOStatement
     */
    private $statement;

    public function __construct(array $config)
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['dbname'],
            'utf8'
        );

        $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true
        ]);
    }

    /**
     * @return void
     */
    public function close()
    {
        $this->pdo = null;
    }

    /**
     * @param string $sql
     * @param array $values
     * @return $this
     */
    public function execute($sql, array $values = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);
        return $this;
    }

    /**
     * @return int
     */
    public function lastInsertedId()
    {
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * @return array|null
     */
    public function fetchOne()
    {
        $record = $this->statement->fetch();

        if ($record === false) {
            return null;
        }

        return $record;
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }
}
