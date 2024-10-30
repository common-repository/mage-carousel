<?php


add_shortcode( 'mage-carousel', 'mpc_carousel' );

function mpc_carousel($atts, $content=null){

        $defaults = array(
            "id"             => "",
            "cat"            => "",
            "item"           => "-1",
            "row"            => "1",
            "loop"           => "true",
            "autoplay"       => "true",
            "dots"           => "true",
            "nav"            => "false",
            "speed"          => "3000"
        );

        $params                   = shortcode_atts($defaults, $atts);
        $uid                      = $params['id'];
        $item                     = $params['item'];
        $cat                      = $params['cat'];
        $row                      = $params['row'];
        $carloop                  = $params['loop'];
        $autoplay                 = $params['autoplay'];
        $dots                     = $params['dots'];
        $nav                      = $params['nav'];
        $speed                    = $params['speed'];


if($cat){
     $args = array (
                     'post_type'        => array( 'mpc_carousel' ),
                     'posts_per_page'   => $item,
                     'tax_query'        => array(
                            array(
                            'taxonomy'  => 'mpc_carousel_cat',
                            'field'     => 'slug',
                            'terms'     => $cat
                            )
                        )
                );
}else{
    $args = array (
           'post_type'      => array( 'mpc_carousel' ),
           'posts_per_page' => $item,
        );     
}
ob_start();
?>
<ul id="mage-people-carousel<?php echo "-".$uid; ?>" class="owl-carousel owl-theme mage-carousel">
        <?php 
            $loop = new WP_Query( $args );
            while ($loop->have_posts()) {
                $loop->the_post(); 
        ?>
         <li><img src='<?php echo the_post_thumbnail_url('full'); ?>'" alt=""></li>
    <?php } ?>      
    <?php wp_reset_query(); ?>    
</ul>
<script>
        jQuery(document).ready(function() {
        
            jQuery('#mage-people-carousel<?php echo "-".$uid; ?>').owlCarousel({
                loop:<?php echo $carloop; ?>,
                margin:0,
                autoplay:<?php echo $autoplay; ?>,
                responsiveClass:true,
                dots:<?php echo $dots; ?>,
                nav:<?php echo $nav; ?>,
                startPosition:0,
                autoplayTimeout:<?php echo $speed; ?>,
                navText:['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
                responsive:{
                    0:{
                        items:1,
                        dots:true,
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:<?php echo $row; ?>
                        
                    }
                }
            })


        });
</script>
<?php 
$content = ob_get_clean();
return $content;
}