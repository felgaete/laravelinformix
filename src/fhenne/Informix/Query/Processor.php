<?php namespace Fhenne\Informix\Query;

use Illuminate\Database\Query\Processors\Processor as BaseProcessor;
use Illuminate\Database\Query\Builder;

class Processor extends BaseProcessor
{
	public function processColumnListing($results)
    {
        return array_values(array_map(function($r) { $r = (object) $r; return $r->column_name; }, $results));
    }
}
