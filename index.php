<?php
   /*
   Plugin Name: AppYourself Chat
   Plugin URI: http://appyourselfchat.com
   description: a plugin to create Small widget chat box
   Version: 1.2
   Author: AppYourself Chat
   Author URI: http://appyourselfchat.com
   License: SW1
   */
   
function appyourselfchat_head_script() { 
    $appyourselfchat_key_get = get_option( 'appyourselfchat_key' );
    wp_enqueue_script('jquery');  // Enqueue jQuery that's already built into WordPress
    if($appyourselfchat_key_get != ''){
    wp_enqueue_script( 'radir-script', '//redir.apptivate.it/'.$appyourselfchat_key_get.'.js');
    }
    wp_enqueue_script( 'custom-script', plugin_dir_url( __FILE__ ) .'js/appyourselfchat.js', array(), '1.0', true );
    wp_enqueue_style( 'custom-css', plugin_dir_url( __FILE__ ) .'css/appyourselfchat.css');
}
add_action( 'wp_enqueue_scripts', 'appyourselfchat_head_script' ); //Hooks our custom function into WP's wp_enqueue_scripts function

add_action( 'wp_head', 'appyourselfchat_footer_scripts' );
function appyourselfchat_footer_scripts(){
    $appyourselfchat_key_get = get_option( 'appyourselfchat_key' );
    if($appyourselfchat_key_get != ''){
?>
<span class="small-widget-cat">Chat Now</span>
<?php
}
else{
    
}
}

function appyourself_register_settings() {
   add_option( 'appyourselfchat_key', 'Get AppYourself Chat Key.');
   register_setting( 'appyourselfchat_options_group', 'appyourselfchat_key', 'appyourselfchat_callback' );
}
add_action( 'admin_init', 'appyourself_register_settings' );

function appyourselfchat_register_options_page() {
  add_options_page('AppYourself Chat', 'AppYourself Chat', 'manage_options', 'appyourselfchat', 'appyourselfchat_page');
}
add_action('admin_menu', 'appyourselfchat_register_options_page');

function appyourselfchat_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>AppYourself Chat Setting</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'appyourselfchat_options_group' ); ?>
  <h3>Get AppYourself Chat Key</h3>
  <p>AppYourself Chat Key.</p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="appyourselfchat_key">Key</label></th>
  <td><input type="text" id="appyourselfchat_key" name="appyourselfchat_key" placeholder="Enter your key" value="<?php echo get_option('appyourselfchat_key'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>
