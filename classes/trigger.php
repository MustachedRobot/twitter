<?php

namespace Twitter;
use Mustached\Plugin;

class Trigger
{

    /**
     * This action is triggered after a user checks in. 
     * If the user has checked the checkbox "publish on twitter" on the checkin form, a tweet is sent on behalf of the coworking space twitter account
     * 
     * @param Array $options Options 
     * 
     * @return Mixed True on Success
     */
    public function postCheckin($options)
    {
        \Lang::load('twitter::twitter.yml', 'twitter');
        
        $fieldset = $options['fieldset'];
        
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            if ($fields['twitter']) {

                $um = new \User\Manager;
                $user = $um->get_user_from_email($fields['email']);

                $c = new \Checkin\Manager;
                $reason = $c->get_reason($fields['reason']);

                $twitter_name = empty($user['twitter']) ? '' : '(@'.$user['twitter'].')';

                try {
                    $twitter = new \Twitter(Plugin::getConfig('twitter', 'consumerKey.value'), Plugin::getConfig('twitter', 'consumerSecret.value'), Plugin::getConfig('twitter', 'accessToken.value'), Plugin::getConfig('twitter', 'accessTokenSecret.value'));
                    $twitter->send(__('twitter.tweet', array('firstname' => $user['firstname'], 'lastname' => $user['lastname'], 'pseudo' => $twitter_name, 'reason' => $reason))); 
                } catch(\Exception $e) {
                    return $e->getMessage();
                }
                return true;
            } else {
                //echo 'No tweet';
            }
        }       
    }
}