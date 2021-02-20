<script>
    function setLoading(){
        var loading_text = $('.loading').data('loading-text');
        $('.loading').html(loading_text).attr('disabled', true);
    }

    function hideLoading(){
        $('.loading').html('Submit').attr('disabled', false)
    }
</script>