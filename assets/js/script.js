(function($){
    function initHoverVideo($scope) {
        $scope.find('.elementor-hover-video-container').hover(
            function() {
                var video = $(this).find('video').get(0);
                if (video) {
                    video.play();
                }
            },
            function() {
                var video = $(this).find('video').get(0);
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            }
        );
    }

    // Untuk preview page biasa
    $(document).ready(function(){
        $('.elementor-hover-video-container').each(function(){
            initHoverVideo($(this));
        });
    });

    // Untuk editor Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/hover_video_widget.default', function($scope){
            initHoverVideo($scope);
        });
    });

})(jQuery);
