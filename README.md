# Flarum authentication with Wordpress site user account

Extension provides authentication into Flarum forum with Wordpress site account.

Extension settings on administration panel|
---------|
![Flarum wp extension settings](/resources/docs/wp-settings.png) |

Forum login popup with activated Wordpress extension|
---------|
![Flarum login form](/resources/docs/log-in-form.png) |

## Installation

```
composer require arslanim/flarum-ext-auth-wp
```
Configure extension at Flarum extensions management page.

    App id   - Your forum identifier in Wordpress-site
    App secret     - Your forum secret key from Wordpress-site
    Wordpress site url  - Your Wordpress-site url

App id and App secret are generate by "WP REST API - OAuth 1.0a Server" plugin in Wordpress site. For more information about required plugins on Wordpress site proceed to [wordpress setup](#wordpress-setup) section.

## Wordpress setup

Assuming that you have already installed wordpress site, lets take a look on plugin installation. For authorization/authentication from Flarum forum, using flarum-ext-auth-wp, you need to instal two plugins on Wordpress site:
 1. WP REST API - OAuth 1.0a Server (v. 0.2.1 or higher) -  JSON-based REST API for WordPress, originally developed as part of GSoC 2013;
 2. WP REST API (2.0-beta14 or higher) - Authenticate with your site via OAuth 1.0a.

Link: http://v2.wp-api.org/

When installation will be completed -> activate plugins from Plugins page in Wordpress console.

Then you need to register new application (your forum based on Flarum). Go to WP admin panel and navigate to
`Users -> Applications`:

![Wordpress applications](/resources/docs/wp-application.png)

`Add new` application:

![Wordpress addapplications](/resources/docs/wp_add_app.png)

Fill fields and click `Add Consumer`. After that you will be redirecting to `Edit Application` page:

![Wordpress editapp](/resources/docs/wp_edit_app.png)

Below there is `OAuth Credentials` section with `Client Key` and `Client Secret` values. This values you need to copy to `flarum-ext-auth-wp` extension settings on Flarum `Extensions` page:

![Flarum ext](/resources/docs/flarum_ext_settings.png)

Then click `Save Changes`. Aaaaaaaaaand that's it! Now you can use your Wordpress site account for login on your awesome Flarum forum. GLHF ;)
