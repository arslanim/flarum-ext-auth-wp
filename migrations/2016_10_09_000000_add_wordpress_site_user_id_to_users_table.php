<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
	'wordpress_id' => ['string', 'length' => 255, 'nullable' => true]
]);