<?php

namespace Arslanim\Auth\Wordpress\Listener;

use Flarum\Event\ConfigureForumRoutes;
use Illuminate\Contracts\Events\Dispatcher;

class AddWordpressAuthRoute {

	//register forum routes
	public function subscribe(Dispatcher $events) {
		$events->listen(ConfigureForumRoutes::class, [$this, 'configureForumRoutes']);
	}

	//specifying action class
	public function configureForumRoutes(ConfigureForumRoutes $event) {
		$event->get(
			'/auth/wordpress', //route URI
			'auth.wordpress', //A route unique name
			'Arslanim\Auth\Wordpress\WordpressAuthController'//Action class to handle request
		);
	}

}
