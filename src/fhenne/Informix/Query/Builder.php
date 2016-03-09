<?php namespace fhenne\Informix\Query;

use Closure;
use DateTime;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use fhenne\Informix\Connection;

class Builder extends BaseBuilder
{
    /**
     * Create a new query builder instance.
     *
     * @param Connection $connection
     * @param Processor  $processor
     */
    public function __construct(Connection $connection, Processor $processor)
    {
        $this->grammar = new Grammar;
        $this->connection = $connection;
        $this->processor = $processor;
    }
}
