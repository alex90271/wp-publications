(function($) {
    $(document).ready(function() {
        // Initialize the color picker on your inputs
        $('.wpap-color-picker').wpColorPicker({
            // You can customize the color picker if needed
            defaultColor: false,
            change: function(event, ui) {
                // Optional: do something when color changes
            },
            clear: function() {
                // Optional: do something when color is cleared
            },
            hide: true,
            palettes: true
        });
    });
})(jQuery);