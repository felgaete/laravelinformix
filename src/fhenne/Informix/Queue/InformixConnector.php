<?php namespace fhenne\Informix\Queue;

use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Queue\Connectors\ConnectorInterface;
use PDO;
use Illuminate\Database\Connectors\Connector;

class InformixConnector extends Connector implements ConnectorInterface
{
    // protected $options = [
    //     PDO::ATTR_CASE => PDO::CASE_NATURAL,
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
    //     PDO::ATTR_STRINGIFY_FETCHES => false,
    // ];
    protected $connections;

    public function __construct(ConnectionResolverInterface $connections)
    {
        $this->connections = $connections;
    }

    public function connect(array $config){
        $dsn = $this->getDsn($config);
        $options = $this->getOptions($config);
        $connection = $this->createConnection($dsn, $config, $options);

        return $connection;
    }

    protected function getDsn(array $config){
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
}
