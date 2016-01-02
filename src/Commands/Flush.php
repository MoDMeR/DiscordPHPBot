<?php

namespace Bot\Commands;

use Discord\Exceptions\PartRequestFailedException;

class Flush
{
	/**
	 * Handles the message.
	 *
	 * @param Message $message 
	 * @param array $params
	 * @param Discord $discord 
	 * @param Config $config 
	 * @return void 
	 */
	public static function handleMessage($message, $params, $discord, $config)
	{
		$rmmessages = (isset($params[1])) ? $params[1] : 15;
		$channel = $message->channel;
		$num = 0;
		$channel->message_count = $rmmessages;

		foreach ($channel->messages as $key => $message) {
			try {
				$message->delete();
			} catch (PartRequestFailedException $e) {
				continue;
			}
			$num++;
		}

		$message->reply("Flushed {$num} messages.");
	}
}