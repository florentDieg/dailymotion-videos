<?php

class DailymotionVideosAdmin {

    public function __construct() {
        
        $this->hooks();
        
    }

    
    /**
     * Hooks
     */
    public function hooks(){
        add_action('admin_menu', array($this, 'addMenu'));
        add_action('admin_init', array($this, 'registerSettings'));
    }

    /**
     * Add resources to wp enqueue
     */
    public function addScripts(){

        ###
        # CSS
        ###
        

    }

    /**
     * Ajoute les scripts js à exécuter pour la page d'administration
     */
    public function adminScripts(){
        
    }

    /**
     * Fonction qui ajoute le Menu dans wp-admin
     */
    public function addMenu()
    {
        add_menu_page('Dailymotion Videos Plugin Options', 'Dailymotion Videos', 'manage_options', 'dailymotionVideos', array($this, 'menuView'));
    }

    /**
     * Fonction qui contient le contenu a afficher pour la page d'administration du plugin
     */
    public function menuView(){
        
        echo '<h1>'.get_admin_page_title().'</h1>';
        echo '<br />';
        
        echo'<div style=\'width: 580px; height: auto; display: block; float: left;  margin-right: 64px;\'>
                <div style=\'width: 100%; height: auto;\'>
                    <form method="post" action="options.php">';
                        settings_fields('dailymotionVideosOptions');
                        do_settings_sections( 'dailymotionVideosOptions' );
                      echo '<div style=\'width: 100%; height: auto; border: 1px solid gray; padding: 16px; margin-bottom: 16px;\'>
                            <label for=\'dmusername\'>Nom d\'utilisateur Dailymotion</label>
                            <input type=\'text\' id=\'dmusername\' name=\'dmusername\' placeholder="Nom d\'utilisateur" style="width: 100%; height: 40px; margin-top: 8px; margin-bottom: 8px;" value="'.get_option('dmusername').'">
                            <label for=\'dmpassword\'>Mot de passe Dailymotion</label>
                            <input type=\'password\' id=\'dmpassword\' name=\'dmpassword\' placeholder="Mot de passe" style="width: 100%; height: 40px; margin-top: 8px; margin-bottom: 8px;" value="'.get_option('dmpassword').'">
                      </div>';
                        submit_button();
                echo '</form>
                </div>
            </div>';
    }

   
    /**
     * Fonction qui déclare les options pour le plugin afin de sauvegarder les options choisies par l'utilisateur
     * dans la table options de la BDD
     */
    public function registerSettings()
    {
        register_setting('dailymotionVideosOptions', 'dmusername');
        register_setting('dailymotionVideosOptions', 'dmpassword');
        
    }

}