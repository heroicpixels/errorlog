<?php 

/**
 *	Copyright 2015 - Dave Hodgins
 */
 
namespace Heroicpixels\ErrorLog;

use Illuminate\Support\Facades\Config;

class ErrorLog extends \Illuminate\Database\Eloquent\Model {
	
	protected $table = 'error_log';
	
	public function getConnection() {
        return static::resolveConnection(
			'error-log'
		);
    }

}
