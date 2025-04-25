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

            <?php $pi_user = get_user_by('id', $pi); ?>
            <!-- START SHOW PI -->
                                                
            <?php if ($pi_user): ?> 

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb2">

                    <div class="profile bg-default border border-light py3 px2 center relative">

                        <div class="px3">
                            <figure class="circle mx-auto">                           
                                <p class="mx-auto flex-auto block"><?php echo esc_html($pi_user->display_name); ?></p>
                            </figure>              
                        </div>
                        
                        <div class=" center">
                            <h4 class="m0 mb2"><?php echo esc_html($pi_user->display_name); ?></h4>
                            <p><?php echo esc_html($pi_user->user_email); ?></p>
                        </div>
                        <span class="pi"></span>                    
                    
                    </div>  <!--end profile -->

                </div><!--end profile wrap-->

            <?php endif; ?>              

        <?php endif; ?>
        <!-- END SHOW PI -->




        <!-- START SHOW CO-PI -->
        <?php $co_pis = get_post_meta( get_the_ID(), 'investigators_select', true );?>

        <?php if( !empty( $co_pis ) ) : ?>
        
        <?php foreach ($co_pis as $co_pi_id): ?>
            <?php $co_pi_user = get_user_by('id', $co_pi_id); ?>
            <?php if ($co_pi_user): ?>

                <div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb2">

                    <div class="profile bg-default border border-light py3 px2 center">

                        <div class="px3">
                            <figure class="circle mx-auto">                           
                                <p class="mx-auto flex-auto block"><?php echo esc_html($co_pi_user->display_name); ?></p>
                            </figure>                      
                        </div>    
                            
                        <div class=" center">
                            <h4 class="m0 mb2"><?php echo esc_html($co_pi_user->display_name); ?></h4>
                            <p><?php echo esc_html($co_pi_user->user_email); ?></p>
                        </div>
                            
                    </div>  

                </div>

            <?php endif; ?>
        <?php endforeach; ?>              
    
        <?php endif; ?>
        <!-- END SHOW CO-PI -->


    </div>
    <!-- investigators end -->




