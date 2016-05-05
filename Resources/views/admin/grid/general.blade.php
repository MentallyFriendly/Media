@include('media::admin.grid.partials.content')
<script>
    $(document).ready(function () {
        $('.jsInsertImage').on('click', function (e) {
            e.preventDefault();
            var mediaId = $(this).data('id');
            var additionalData = {
                'selectedSize': $(this).data('file')
            };
            window.opener.includeMedia(mediaId, additionalData);
            window.close();
        });
    });
</script>
</body>
</html>
