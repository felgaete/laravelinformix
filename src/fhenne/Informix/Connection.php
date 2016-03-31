<?php namespace fhenne\Informix;

use fhenne\Informix\Query\Processor;
use fhenne\Informix\Query\Grammar;
use Illuminate\Database\Connectors\Connector;

class Connection extends \Illuminate\Database\Connection
{

    protected $db;
    protected $connection;

    // protected $options = [
    //     PDO::ATTR_CASE => PDO::CASE_NATURAL,
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
    //     PDO::ATTR_STRINGIFY_FETCHES => false,
    // ];


    public function __construct(array $config)
    {
        $this->config = $config;

        // Build the connection string
        $dsn = $this->getDsn($config);


        // Create the connection
        $connector = new Connector();
        
        //Get options from config
        $options = $connector->getOptions($config);
        
        $this->connection = $connector->createConnection($dsn, $config, $options);
        $this->setPdo($this->connection);
        $this->setQueryGrammar(new Grammar());
        $this->setPostProcessor(new Processor());

    }

    protected function getDSN(array $config) {
        extract($config);

        $host = isset($host) ? "host={$host};" : '';
        $port = isset($port) ? "service={$port};" : '';
        $server = isset($server) ? "server={$server};" : '';
        $dsn = "informix:{$host}database={$database};{$port}{$server}";

        if(isset($config['protocol'])){
            $dsn .= "protocol={$protocol};";
        }

        return $dsn;
    }

    protected function getDefaultQueryGrammar(){
        return $this->withTablePrefix(new Grammar());
    }

//    protected function getDefaultSchemaGrammar(){
//        return $this->withTablePrefix(new SchemaGrammar);
//    }

    protected function getDefaultPostProcessor(){
        return new Processor;
    }

    public function disconnect()
    {
        unset($this->connection);
    }

}
