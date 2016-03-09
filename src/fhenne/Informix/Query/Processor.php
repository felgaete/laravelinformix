<?php namespace fhenne\Informix\Query;

use Illuminate\Database\Query\Processors\Processor as BaseProcessor;
use fhenne\Informix\Query\Builder;

class Processor extends BaseProcessor
{
	// public function processColumnListing($results)
 //   {
 //       return array_values(array_map(function($r) { $r = (object) $r; return $r->strtoupper(column_name); }, $results));
 //   }
}
