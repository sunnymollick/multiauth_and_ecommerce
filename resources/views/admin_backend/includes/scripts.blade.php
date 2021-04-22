    <!-- JavaScript Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('backend/adminbackend') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/popper.js/popper.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/bootstrap/bootstrap.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/jquery-ui/jquery-ui.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="{{ asset('backend/adminbackend') }}/lib/highlightjs/highlight.pack.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/select2/js/select2.min.js"></script>

    <script>
        $(function(){
          'use strict';

          $('#datatable1').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
            }
          });

          $('#datatable2').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
          });

          // Select2
          $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        });
      </script>


    <script src="{{ asset('backend/adminbackend') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/d3/d3.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/rickshaw/rickshaw.min.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/chart.js/Chart.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/Flot/jquery.flot.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/Flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/Flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/lib/flot-spline/jquery.flot.spline.js"></script>



    <script src="{{ asset('backend/adminbackend') }}/js/starlight.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/js/ResizeSensor.js"></script>
    <script src="{{ asset('backend/adminbackend') }}/js/dashboard.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

  <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script>
	<script>
            $(document).on("click", "#delete", function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                   swal({
                     title: "Are you Want to delete?",
                     text: "Once Delete, This will be Permanently Delete!",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                   })
                   .then((willDelete) => {
                     if (willDelete) {
                          window.location.href = link;
                     } else {
                       swal("Safe Data!");
                     }
                   });
               });
       </script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


       {{-- <script>
           initSample();
       </script> --}}
