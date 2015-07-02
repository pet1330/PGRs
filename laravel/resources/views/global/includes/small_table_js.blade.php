<script type="text/javascript">
  $('#@yield('table_name')').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).attr('href');
  } );
</script>