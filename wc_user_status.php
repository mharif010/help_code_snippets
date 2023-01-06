<?php 
      //subscription duration get  
      $subscriptions = wcs_get_users_subscriptions( $user_id );
      $subscription_id = key($subscriptions);
      $subscription_time = wcs_get_subscription( $subscription_id );
      $timeFirst  = strtotime($subscription_time->get_date( 'start' ));
      $timeSecond = strtotime($subscription_time->get_date( 'end' ));
      $differenceInSeconds = $timeSecond - $timeFirst;
      $subs_duration = round($differenceInSeconds / (60 * 60 * 24));

      //echo 'Hello test';1201-subsc and order 679-simple and unorder
      $product_id = 1201;
      $product = wc_get_product( $product_id );
      $isUserStats = '';
      $isCheckBuy = wc_customer_bought_product( $user->email, $user_id, $product_id );
      $has_sub = wcs_user_has_subscription( $user_id, $product_id, 'active');

      if( $isCheckBuy ){
          if ( $product->is_type( 'subscription' ) && $has_sub ) {
              if( $subs_duration >= 360 ){
                $isUserStats = 'prime';
              }elseif( $subs_duration >= 182 ){
                $isUserStats = 'premium';
              }elseif( $subs_duration >= 30 ){
                $isUserStats = 'monthly';
              }else{
                $isUserStats = 'regular';
              }                            
          }elseif( $product->is_type( 'simple' ) ){
              $isUserStats = 'simple';
          }else{
              $isUserStats = 'regular';
          }
      }else{
        $isUserStats = 'Product not purchased';
      }
    ?>

    <h3 class="text-center">Status : <b><?php echo ucfirst($isUserStats); ?> Member</b></h3>
