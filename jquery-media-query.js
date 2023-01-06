<script>
    jQuery(document).ready(function() {
        jQuery(window).on("resize", function(e) {
            checkScreenSize();
        });

        checkScreenSize();

        function checkScreenSize() {
            var newWindowWidth = jQuery(window).width();
            if (newWindowWidth < 991) {

                //jQuery('.unit_sidebar').appendTo($('.sd'));

                var textElements = jQuery('.unit_sidebar');
                jQuery('.unit_sidebar').remove();
                jQuery('.forMobileSidebarAds').html(textElements);
            }
        }
    });
</script>
