<?php

namespace App\Services;

use App\Events\NodeDown;
use App\Models\Node;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NodeService
{
	public function ping(Node $node)
	{
		try {
			// talk to python api here
			$url = 'http://127.0.0.1:5000/node/status';
			$parameters = array(
			      'ip_address' => $node->ip_address
			);
			$query = http_build_query($parameters);
			$url .= '?' . $query;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			$status = curl_exec($ch);  

			if ($status == 'up') {
				$node->node_status_id = 2;
			} elseif ($status == 'down') {
				$node->node_status_id = 3;
				if (!$node->alert_sent) {
					NodeDown::dispatch($node);
				}
				$node->alert_sent = 1;
			}

			Log::info($node->ip_address . ' ' . $node->nodeStatus->name);
			
			$node->save();
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
	}
}