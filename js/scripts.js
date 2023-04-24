(function ($) {
    $(document).ready(function () {
        $.ajax({
            url: window.wp_data.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_latest_posts_content'
            },
            success: function (response) {
                $.each(response, function (index, post) {
                    let postContent =
                        '<div class="post">' +
                            '<h3>' + ++index + '</h3>' +
                            '<div class="content">' + post + '</div>' +
                        '</div>';
                    $('body').append(postContent);
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
})(jQuery);
