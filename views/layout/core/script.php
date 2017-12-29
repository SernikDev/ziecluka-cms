<script>
    $(document).ready(function () {
        $('.parallax').parallax();
        $('select').material_select();
        $(".button-collapse").sideNav({closeOnClick: true, edge: 'right'});
        $(document).ready(function () {
            $('.tooltipped').tooltip({delay: 50, position: 'top', tooltip: 'Funkcja niebawem zacznie działać - w przygotowaniu'});
        });
        $('.scrollspy').scrollSpy({scrollOffset: 0});
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        $('.scrollToTop').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    });
</script>