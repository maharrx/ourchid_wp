

    <!-- funding start -->
    <div class="funding clearfix mxn2 pb4">
        <h2 class="m0 px2 pb3">Funding</h2>

            
        <?php 
            $entries = get_post_meta( get_the_ID(), 'funding_repeat_group', true );

            foreach ( (array) $entries as $key => $entry ) {
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
                                
        <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">
            <a class="block border border-light" href="<?php echo $url; ?>" target="_blank">
                <?php echo ($img); ?>
            </a>
        </div>

        <?php   
            }
        ?>

    </div>
    <!-- funding end -->


    <!-- investigators start -->
    <div class="investigators clearfix mxn2 pb4">
        
        <h2 class="m0 px2 pb3">Investigators</h2>
        
        
        
        <?php 
            //the PI
            $pi = get_post_meta( get_the_ID(), 'PI_select', true );                         
            $pi_query = new WP_Query(array('post_type' => 'members','post__in' => array ($pi)) );
        ?>

        <!-- START SHOW PI -->
        <?php if ( $pi_query->have_posts() ):?>
                                        
            <?php while ( $pi_query->have_posts() ) : $pi_query->the_post(); ?> 

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">

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

        <?php  else: ?>
            <?php echo "No content found!"; ?>                          
        <?php endif; ?>
        <!-- END SHOW PI -->



        <!-- START SHOW CO-PI -->
        <?php 
            //the co-PIs
            $co_pis = get_post_meta( get_the_ID(), 'investigators_select', true );                          
            $co_pis_query = new WP_Query(array('post_type' => 'members','post__in' => $co_pis));
        ?>

        <?php if ( $co_pis_query->have_posts() ):?>
                                
            <?php while ( $co_pis_query->have_posts() ) : $co_pis_query->the_post(); ?> 

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">

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

        <?php  else: ?>
            <?php echo "No content found!"; ?>                          
        <?php endif; ?>
        <!-- END CO-PI -->


    </div>
    <!-- investigators end -->


                        

     