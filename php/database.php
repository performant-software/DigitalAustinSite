<?php

	function logString($logMsg)
	{
		if(false) {
			$handle = fopen('/home/benwbrum/dev/clients/torget/dap/DigitalAustinSite/debug.log', 'a+');
			fwrite($handle, "\n" );
			fwrite($handle, $logMsg );
			fwrite($handle, "\n" );

			fclose($handle);
		}
	}

	// Compatibility function since mysqli lacks an equivalent to mysql_result
	function mysqli_result($res, $row, $field=0)
	{
		$res->data_seek($row);
		$datarow = $res->fetch_array();
		return $datarow[$field];
	}

	function connectToDB()
	{
        $connection = ($GLOBALS["___mysqli_ston"] = mysqli_connect(
						$_ENV['DB_HOSTNAME'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']));
		return $connection;
	}

?>
