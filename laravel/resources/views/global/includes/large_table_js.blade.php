<script type="text/javascript">
  $(document).ready( function () {
    
    $('#@yield('table_name')').DataTable({
      "iDisplayLength": 25,
    });

    // Setup - add a text input to each footer cell
    $('#@yield('table_name') tfoot th').each( function () {
      var title = $('#@yield('table_name') thead th').eq( $(this).index() ).text();
      $(this).html( '<input type="text" placeholder="Filter" />' );
    } );
    
    // DataTable
    var table = $('#@yield('table_name')').DataTable();
    
    // Apply the search
    table.columns().every( function () {
      var that = this;
      
      $( 'input', this.footer() ).on( 'keyup change', function () {
        that
        .search( this.value )
        .draw();
      } );
    } );

  } );

  $('#@yield('table_name')').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).attr('href');
  } );
</script>