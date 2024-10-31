<?php
/*
Plugin Name: Nepali Jokes
Plugin URI: http://khoyaa.com/jokes/nepali-jokes/
Description: Best nepali jokes feed on your siderbar.
Author: khoyaa
Author URI: https://profiles.wordpress.org/khoyaa
Version: 1.0.1
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if(!class_exists('Ky_NepaliJokes'))
{
  
  class Ky_NepaliJokes
  {
    private $plugin_url;
    
    public function __construct()
    {
      add_action( 'widgets_init',         array($this,'register_jokes_widget'));
      add_action( 'wp_enqueue_scripts',   array($this,'jokes_assests') );
      register_activation_hook( __FILE__, array($this,'Ky_activate') );
      
      $this->plugin_url                   = plugins_url('/',__FILE__);
    }
    
    public function register_jokes_widget()
    {
      include 'nepali-jokes-widget.php';
      register_widget( 'NepaliJokes_Widget' );
    }
    
    public function jokes_assests()
    {
      wp_enqueue_style( 'jokes-style', $this->plugin_url . 'style.css' );
    }
    
    public function Ky_activate() {   }

  }
  
  new Ky_NepaliJokes;
  
}
