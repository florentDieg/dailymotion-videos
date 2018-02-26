<?php
/*
Plugin Name: Dailymotion Videos
Plugin URI: https://uneviedenerd.xyz
Description: Un plugin qui récupère et affiche pour un utilisateur donné ses vidéos dailymotion
Version: 1.0.0
Author: Florent OGOUTCHORO
Author URI: https://uneviedenerd.xyz
License: GPL2
*/

require_once __DIR__.'/vendor/autoload.php';


class DailymotionVideos
{
    private $apiKey = "3abd670eba1e739185cc";
    private $apiSecret = "951cf7be70cff0f4bf00422a5e8add1e5bf0cc64";
    private $api;

    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'/DailymotionVideosAdmin.php';
        new DailymotionVideosAdmin();

        $this->hooks();
        $this->setDailymotionApi();
    }

    /**
    * Hooks
    */
    public function hooks(){
        add_shortcode('dailymotionvideos', array($this, 'dailymotionVideosShortcode'));
    }

    /**
     * Add resources to wp enqueue
     */
    public function addScripts(){

        ###
        # CSS
        ###
        
        
        ###
        # JS
        ###
        

    }

    /**
     * Fonction qui initialise la connection avec l'api dailymotion
     */
    public function setDailymotionApi(){
        $this->api = new Dailymotion();
        $this->api->setGrantType(
            Dailymotion::GRANT_TYPE_PASSWORD, 
            $this->apiKey,
            $this->apiSecret,
            array(), // OAuth 2.0 scopes that you'd like to be granted by the end-user
            array(
                'username' => get_option('dmusername'), // don't forget to sanitize this,
                'password' => get_option('dmpassword'), // never use POST variables this way
            )
        );
    }

    /**
     * Fonction qui récupère les vidéos dailymotion de l'utilisateur
     */
    public function getUserVideos(){
        $result = $this->api->get(
            '/me/videos',
            array('fields' => array('id', 'title', 'owner', 'url'), 'limit' => 100)
        );

        return $result;
    }

    /**
     * Fonction qui exécute le shortecode et affiche les vidéos récupérées
     */
    public function dailymotionVideosShortcode(){
        $results = $this->getUserVideos();
        $html = array();
        $html[] = '<div class="container">';
        foreach ($results['list'] as $result) {
            $html[] = '<div class="col-md-6" style="margin-bottom: 24px;"><iframe frameborder="0" width="100%" height="360"
src="//www.dailymotion.com/embed/video/'.$result['id'].'?PARAMS"
allowfullscreen></iframe></div>';
        }
        $html[] = '</div>';
    
        echo implode('', $html);
        //var_dump($results);
    }
}

new DailymotionVideos();