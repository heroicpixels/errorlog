<?php 

/**
 *	Copyright 2015 - Dave Hodgins
 */

namespace Heroicpixels\ErrorLog;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ErrorLogServiceProvider extends ServiceProvider {

	protected $defer = false;

	public function boot() {
		$this->package('heroicpixels/errorlog');
		App::before(function($request, $response) {
			Log::listen(function($level, $message, $context) use ($request, $response) {
				$ip = sprintf('%u', ip2long($request->server('REMOTE_ADDR')));
				$uri = $uri = str_replace(str_replace('/index.php', '', $request->server('SCRIPT_NAME')), '', $request->server('REQUEST_URI'));
				ErrorLog::insert(array(
					'message'		=> $message->getMessage(), 
					'line' 			=> $message->getLine(),
					'file'			=> $message->getFile(),
					'uri'			=> $uri,
					'ip' 			=> $ip,
				));
			});
		});
	}
	
	public function register() {
		
	}

}
