## Twitter plugin for Mustached Robot

This plugin sends a Tweet from the coworking space Twitter account when a coworker checks in (the coworker can uncheck the Tweet before he checks-in).

### Installation

Add the plugin as a dependency in the composer.json of your installation

    "require": {
        // .. other dependencies
        "mustached-robot/twitter": "dev-master"
    }

Run composer update:

    php composer.phar update

### Configuration

#### Create a Twitter Application

* Log in to http://dev.twitter.com with your coworking space account.
* Create an application 
* In the Details tab, click the button "Create an access token"
* Go to the oAuth Tools tab, you will need informations on this page

#### Configure Mustached Robot

* Login to your Mustached Robot admin account, then go to Settings > Twitter
* Enter the required informations (Consumer key, Consumer Secret, Access Token, Access token secret)