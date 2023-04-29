<?php

namespace Qoverflow\Store;

class MySqlRateLimiterStore implements Store
{
    private $db; // database handle

    /**
     * db table rate limit:
     * id int(11) auto_increment
     * timestamp int(11) not null
     */

    public function __construct($db)
    {
        $this->db = $db;
    }

	public function get(): array
	{
        $db->query("DELETE FROM rate_limit WHERE timestamp < UNIX_TIMESTAMP(NOW() - 60)");
		$db->query("SELECT * FROM rate_limit ORDER BY ID DESC LIMIT 11");
		
		$arr = [];
		foreach ($db->fetchArray() as $row) {
			$arr[] = $row['timestamp'];
		}

		return $arr;
	}

	public function push(int $timestamp, int $limit)
    {
        $db->query("INSERT INTO rate_limit VALUES (null, $timestamp)");
    }
}