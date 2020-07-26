<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin_services 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href={{ asset('/admin_services/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href={{ asset('/admin_services/css/sb-admin-2.min.css') }} rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Faculty Edit Modal --}}
  <div class="modal fade" id="facultyEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Faculty Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control">
              <span class="text-success" id="faculty_updated_successfully"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="faculty_update_button">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>

  
  <!-- Bootstrap core JavaScript-->
  <script src={{ asset('/admin_services/vendor/jquery/jquery.min.js') }}></script>
  <script src={{ asset('/admin_services/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

  <!-- Core plugin JavaScript-->
  <script src={{ asset('/admin_services/vendor/jquery-easing/jquery.easing.min.js') }}></script>

  <!-- Custom scripts for all pages-->
  <script src={{ asset('/admin_services/js/sb-admin-2.min.js') }}></script>

  <!-- Page level plugins -->

  <!-- Page level custom scripts -->
  <script>
    $('#facultyEditModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var faculty_id = button.data('faculty_id');
      $('#faculty_update_button').attr('faculty_id', faculty_id);
      var modal = $(this);
      $.ajax({
        type: "GET",
        url: `http://newwave.local/admin/faculties/${faculty_id}/edit`,
        dataType: "json",
        data: {
          faculty_id: faculty_id
        },
        success: function(data){
          modal.find('.modal-body [name*="name"]').val(data.faculty.name);
          console.log(data);
        }
      });
    });

    $('#faculty_update_button').on('click', function(){
        var faculty_id = $(this).attr('faculty_id');
        // console.log(faculty_id);
        var name = $("input[name*='name']").val();
        $.ajax({
          type: "POST",
          url: `http://newwave.local/admin/faculties/${faculty_id}`,
          dataType: "json",
          data: {
            _token: "{{ csrf_token() }}",
            _method: "PUT",
            name: name
          },
          success: function(data){
            console.log(data);
            $('#faculty-name-' + faculty_id).text(name);
            $('#faculty_updated_successfully').text(data.message);
          }
        });
        
      });

    
  </script>
</body>

</html>
