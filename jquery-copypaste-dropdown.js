<script>
    (function($) {
        // alert('this jquery script for copy^ ');    
        $('.course_action_points .course_progressbar').appendTo($('.course_percent'));
        $('.course_timeline').appendTo($('.unit_module_menu'));
        $('.progress div span').appendTo($('.unit_module_progress'));
        $('.unit_module_progress').append('<span> Complete</span>');
        $('.course_pursue_panel').remove();

        // for menu style
        $('.units_menu h3').on('click', function(e) {
            e.preventDefault();
            $('.unit_module_menu').toggleClass('unit_module_visible');
        });

        $(function() { // REMOVE CLASS WHEN YOU CLICK, EXCLUDE ELEMENTS
            var ignore = Array(".units_menu h3", ".unit_module_menu");
            ignore.forEach(function(item) { 
                $(item).click(function() {
                    return false;
                });
            });

            $(document).on("click", function() { // remove class when you click anywhere else
                $(".unit_module_menu").removeClass('unit_module_visible');
            });
        });

        //toggle for profile 
        $('.profile_modal-toggle').on('click', function(e) {
            e.preventDefault();
            $('.profile_modal').toggleClass('is-visible');
        });

        //toggle for usd 
        $('.usd_modal-toggle').on('click', function(e) {
            e.preventDefault();
            $('.usd_modal').toggleClass('is-visible');
        });

        $(".section").click(function() {
            var sections = $(this).nextUntil(".section").toggle();
        });
        $(".section h4").click(function() {
            document.querySelector('.units_menu h3').innerText = this.innerText;
            $('.units_menu h3').prepend('<i class="fa fa-caret-down for-pc" aria-hidden="true"></i>');
            $('.units_menu h3').append('<i class="fa fa-caret-down for-mobile" aria-hidden="true"></i>');

        });
    })(jQuery);
</script>
