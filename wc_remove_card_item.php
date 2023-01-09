// Remove conditionally cart items based on a specific product (item)
add_action('woocommerce_before_calculate_totals', 'remove_cart_items_conditionally_mha', 10, 1);
function remove_cart_items_conditionally_mha($cart)
{
    // HERE define your specific product ID
    $specific_product_id = 354;

    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $cart_items  = $cart->get_cart();
    $items_count = count($cart_items);

    if ($items_count < 2)
        return;

    $last_item    = end($cart_items);
    $is_last_item = false;

    if (in_array($specific_product_id, array($last_item['product_id'], $last_item['variation_id']))) {
        $is_last_item = true;
    }

    // Loop through cart items
    foreach ($cart_items as $cart_item_key => $cart_item) {
        if (!in_array($specific_product_id, array($cart_item['product_id'], $cart_item['variation_id'])) && $is_last_item) {
            $cart->remove_cart_item($cart_item_key);
            wc_add_notice(__('Due to the presale, AMI products cannot be purchased with other products in the same order.', 'theme_domain'), 'notice');
        } elseif (in_array($specific_product_id, array($cart_item['product_id'], $cart_item['variation_id'])) && !$is_last_item) {
            $cart->remove_cart_item($cart_item_key);
            wc_add_notice(__('Due to the presale, AMI products cannot be purchased with other products in the same order.', 'theme_domain'), 'notice');
        }
    }
}
