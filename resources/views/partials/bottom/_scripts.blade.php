<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Cusotm scripts -->
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/animsition/js/animsition.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/select2/select2.min.js') }}"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
</script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/js/slick-custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/fashe-colorlib/js/main.js') }}"></script>

<!-- Custom scripts for this template -->
@yield('scripts')