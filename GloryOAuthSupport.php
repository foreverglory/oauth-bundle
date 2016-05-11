<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glory\Bundle\OAuthBundle;

/**
 * Description of GloryOAuthSupport
 *
 * @author ForeverGlory
 */
class GloryOAuthSupport
{

    protected static $owners = array(
        'oauth2' => array(
            'amazon', 'auth0', 'azure',
            'bitly', 'box', 'bufferapp',
            'dailymotion', 'deviantart', 'deezer', 'disqus',
            'eve_online', 'eventbrite',
            'facebook', 'fiware', 'foursquare',
            'github', 'google',
            'hubic',
            'instagram',
            'linkedin',
            'mailru',
            'odnoklassniki',
            'paypal',
            'qq',
            'reddit', 'runkeeper',
            'salesforce', 'sensio_connect', 'sina_weibo', 'slack', 'spotify', 'soundcloud', 'stack_exchange', 'strava',
            'toshl', 'trakt', 'twitch',
            'vkontakte',
            'wechat', 'windows_live', 'wordpress',
            'yandex', 'youtube',
            '37signals',
        ),
        'oauth1' => array(
            'bitbucket',
            'discogs', 'dropbox',
            'flickr',
            'jira',
            'stereomood',
            'trello', 'twitter',
            'xing',
            'yahoo',
        ),
    );

    /**
     * Return the type (OAuth1 or OAuth2) of given resource owner.
     *
     * @param string $owner
     *
     * @return string
     */
    public static function getOwnerType($owner)
    {
        if ('oauth1' === $owner || 'oauth2' === $owner) {
            return $owner;
        }

        if (in_array($owner, static::$owners['oauth1'])) {
            return 'oauth1';
        }

        return 'oauth2';
    }

    /**
     * Checks that given resource owner is supported by this bundle.
     *
     * @param string $owner
     *
     * @return Boolean
     */
    public static function isOwnerSupported($owner)
    {
        if ('oauth1' === $owner || 'oauth2' === $owner) {
            return true;
        }

        return in_array($owner, static::$owners['oauth1']) || in_array($owner, static::$owners['oauth2']);
    }

}
