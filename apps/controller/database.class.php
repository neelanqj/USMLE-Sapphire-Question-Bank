<?php

/* 
MVC connection parametes instructions
http://graeson.wordpress.com/2011/01/21/simple-blog-example-6-php-data-objects/
http://net.tutsplus.com/tutorials/php/pdo-vs-mysqli-which-should-you-use/

Scaling the application white paper:
http://www.oracle.com/technetwork/articles/dsl/white-php-part1-355135.html
*/

class Database
{	
	// Configuration information:
	private static $user = 'username';
	private static $pass = 'password';
	
	private static $config = array(
		'write' =>
			array('mysql:dbname=database_usmlesapphire;host=localhost'),
		'read' =>
			array('mysql:dbname=database_usmlesapphire;host=localhost',
				  'mysql:dbname=database_usmlesapphire;host=localhost',
				  'mysql:dbname=database_usmlesapphire;host=localhost'),
		'batch' =>
			array('mysql:dbname=database_usmlesapphire;host=localhost'),
		'comments' =>
			array('mysql:dbname=database_usmlesapphire;host=localhost',
				  'mysql:dbname=database_usmlesapphire;host=localhost')
		);

    // Static method to return a database connection to a certain pool
    public static function getConnection($pool) {
        // Make a copy of the server array, to modify as we go:
        $servers = self::$config[$pool];
        $connection = false;
        
        // Keep trying to make a connection:
        while (!$connection && count($servers)) {
            $key = array_rand($servers);
            try {
                $connection = new PDO($servers[$key], self::$user, self::$pass);
				//echo "setting connection as PDO";
            } catch (PDOException $e) {}
            
            if (!$connection) {
                // Couldn’t connect to this server, so remove it:
                unset($servers[$key]);
            }
        }
        
        // If we never connected to any database, throw an exception:
        if (!$connection) {
            throw new Exception("Failed Pool: {$pool}");
        }
        
		// echo "Returning PDO <br/>";
        return $connection;
    }
}

?>