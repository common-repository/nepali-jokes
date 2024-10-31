
<?php
class NepaliJokes_Widget extends WP_Widget
{
  public function __construct() 
  {
    parent::__construct('nepali-jokes',__('Nepali Jokes', 'nepali-jokes'),array( 'description' => __( 'Best nepali jokes', 'nepali-jokes' ) ));
  }

  public function widget( $args, $instance )
  {
    $site_url                             = 'http://khoyaa.com';
    $loc                                  = '/jokes/nepali-jokes/';
    $sa                                   = $site_url.'/api'.$loc;
    
    $ch                                   = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sa);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $f                                    = curl_exec($ch);
    curl_close($ch);

    $c                                    = json_decode($f);
    ?>
    <div class="nj-box">
      <div class="nj-title"><a href="<?php echo $site_url.$loc; ?>"><?php echo $instance['title'];?></a></div>
      <div class="nj-divider"></div>
      <div class="nj-content">
      <?php foreach( $c as $p ){ $iu = $site_url.'/jokes/'.$p->id.'/'.$p->name.'/';?>
        <div class="nj-c-title"><a class="nj-at" href="<?php echo $iu; ?>"><?php echo $p->title; ?></a></div>
        <div class="nj-c-body"><?php echo $p->content; ?><a href="<?php echo $iu; ?>" class="nj-read">&#2309;&#2333; &#2346;&#2338;&#2381;&#2344;&#2369;&#2361;&#2379;&#2360;&#2381;</a></div>
        <div class="nj-hr"></div>
      <?php } ?>
        <div class="nj-more"><a href="<?php echo $site_url.$loc; ?>">&#2309;&#2333; &#2343;&#2375;&#2352;&#2376; &raquo;</a></div>
      </div>
      <div class="nj-copy">
        <a class="ap" href="<?php echo $site_url; ?>">&copy; khoyaa.com</a>
        <a class="get" href="https://profiles.wordpress.org/khoyaa">get this widget</a>
        <div class="clear"></div>
      </div>
      <div class="nj-divider btm"></div>
    </div>
    <?php
  }
   
  public function update( $new_instance, $instance )
  {
    $instance['title']                    = esc_html($new_instance['title']);
    return $instance;
  }
   
  public function form( $instance )
  {
    $instance                             = wp_parse_args( $instance, array(
                                            'title'           => '&#2344;&#2375;&#2346;&#2366;&#2354;&#2368; &#2330;&#2369;&#2335;&#2381;&#2325;&#2367;&#2354;&#2366;'
                                            ) );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'nepali-jokes'); ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
    </p>
    <?php
  }
}
