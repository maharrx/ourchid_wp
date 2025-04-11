
    <!-- funding start -->
            
    <?php $entries = get_post_meta( get_the_ID(), 'funding_repeat_group', true );?>    

    <?php if( !empty( $entries ) ) : ?>
        <div class="funding clearfix mxn2 pb4">
            <div class="sm-col sm-col-6 md-col-4 lg-col-12 px2">
                <h2 class="pb3">Funding</h2>
        
                <?php foreach ( (array) $entries as $key => $entry ) {
                    $img = $title = $desc = $caption = '';
                    if ( isset( $entry['title'] ) ) {
                        $title = esc_html( $entry['title'] );
                    }

                    if ( isset( $entry['url'] ) ) {
                        $url = esc_html( $entry['url'] );
                    }

                    if ( isset( $entry['image_id'] ) ) {
                        $img = wp_get_attachment_image( $entry['image_id'], 'share-pick', null, array(
                            'class' => 'thumb block',
                        ) );
                                
                    }

                    $caption = isset( $entry['image_caption'] ) ? wpautop( $entry['image_caption'] ) : '';
                ?>  

                <a class="block border p2 bg-default border-light mb2" href="<?php echo $url; ?>" target="_blank">
                    <?php echo ($img); ?>
                </a>

                <?php } ?> <!-- end for each -->

            </div>
        </div> 
    <?php endif; ?> <!-- end if-->

    <!-- funding end -->


    <!-- investigators start -->
    <?php $pi = get_post_meta( get_the_ID(), 'PI_select', true );?>

    <div class="investigators clearfix mxn2 pb4">
    
        <?php if( !empty( $pi ) ) : ?>
                
            <h2 class="px2">Investigators</h2>

            <?php $pi_query = new WP_Query(array('post_type' => 'members','post__in' => array ($pi)) ); ?>
            <!-- START SHOW PI -->
                                                
            <?php while ( $pi_query->have_posts() ) : $pi_query->the_post(); ?> 

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb2">

                    <div class="profile bg-default border border-light py3 px2 center relative">

                        <div class="px3">
                            <figure class="circle mx-auto">                           
                                <?php if( has_post_thumbnail() ):?>
                                    <?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
                                <?php else: ?>
                                    <p class="mx-auto flex-auto block"><?php the_title(); ?></p>
                                <?php endif; ?>
                            </figure>              
                        </div>
                        
                        <div class=" center">
                            <h4 class="m0 mb2"><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                        </div>
                        <?php //if (get_the_id() == $pi) {echo '<span class="pi"> </span>';}?>                            
                        <span class="pi"></span>                    
                    
                    </div>  <!--end profile -->

                </div><!--end profile wrap-->

            <?php 
                endwhile; 
                wp_reset_query();  
            ?>              

        <?php endif; ?>
        <!-- END SHOW PI -->




        <!-- START SHOW CO-PI -->
        <?php $co_pis = get_post_meta( get_the_ID(), 'investigators_select', true );?>

        <?php if( !empty( $co_pis ) ) : ?>
        
        <?php $co_pis_query = new WP_Query(array('post_type' => 'members','post__in' => $co_pis));?>
                                
            <?php while ( $co_pis_query->have_posts() ) : $co_pis_query->the_post(); ?> 

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb2">

                    <div class="profile bg-default border border-light py3 px2 center">

                        <div class="px3">
                            <figure class="circle mx-auto">                           
                                <?php if( has_post_thumbnail() ):?>
                                    <?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
                                <?php else: ?>
                                    <p class="mx-auto flex-auto block"><?php the_title(); ?></p>
                                <?php endif; ?>
                            </figure>                      
                        </div>    
                            
                        <div class=" center">
                            <h4 class="m0 mb2"><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                        </div>
                            
                        <?php //if (get_the_id() == $pi) {echo '<span class="pi"> </span>';}?>

                    </div>  

                </div>

            <?php 
                endwhile; 
                wp_reset_query();
            ?>              
    
        <?php endif; ?>
        <!-- END SHOW PI -->


    </div>
    <!-- investigators end -->


                        

     