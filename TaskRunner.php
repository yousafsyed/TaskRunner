<?php
/**
 * Sync class to upload data from local pc
 * to the servers in given intervals
 * *
 * (The MIT License)
 *
 * TaskRunner is Copyright (c) 2015 Yousaf Syed
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the 'Software'), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so, subject
 * to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
date_default_timezone_set ( 'Europe/London' );
class TaskRunner {
	# Private variable to save the syncInterval time
	private $syncInterval;
	# Last synced time
	private $lastSycnedTime;
	# Task Name
	private $taskName;
	# Sync log tracking file path.
	const SYNC_LOG = "sync_log.json";
	function __construct() {
		if(!file_exists(self::SYNC_LOG)){
			file_put_contents(self::SYNC_LOG, null);
		}
	}
	
	/**
	 *
	 * @param array $config        	
	 * @throws Exception
	 */
	public function config(Array $config) {
		if (! isset ( $config ['syncInterval'] ) || ! isset ( $config ['taskName'] )) {
			throw new Exception ( "All the required configs are not mentioned" );
		} else {
			$this->syncInterval = $config ['syncInterval'];
			$this->taskName = $config ['taskName'];
		}
	}
	
	/**
	 *
	 * @param callable $callback        	
	 * @throws RuntimeException
	 */
	public function run(callable $callback) {
		# Read file
		$sycn_log = json_decode ( file_get_contents ( self::SYNC_LOG ), true );
		if (! is_array ( $sycn_log )) {
			$sycn_log = array ();
		}
		
		if (! isset ( $sycn_log [$this->taskName] )) {
			
			$sycn_log [$this->taskName] = 0;
			file_put_contents ( self::SYNC_LOG, json_encode ( $sycn_log ) );
		} else {
			$this->lastSycnedTime = $sycn_log [$this->taskName];
		}
		
		# Check if its time to sync or not
		# According to the syncInterval
		$currentHour = date ( "H" );
		
		$lastUpdateHour = date ( "H", $this->lastSycnedTime );
		
		if ($currentHour - $lastUpdateHour >= $this->syncInterval) {
			# Call back function
			if (is_callable ( $callback )) {
				# Call the user function
				call_user_func ( $callback );
				# save the new time stamp
				$sycn_log [$this->taskName] = time ();
				file_put_contents ( self::SYNC_LOG, json_encode($sycn_log));
			} else {
				throw new RuntimeException ( 'Your function is not callable.' );
			}
		}
	}
}
