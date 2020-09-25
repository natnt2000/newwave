<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin_services 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset('/admin_services/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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


{{-- Student Info Modal Update --}}
<div class="modal fade" id="updateStudentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Infomation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST" id="update_student_info_form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="student_id">
                    <input type="hidden" name="user_id">
                    <div class="form-group">
                        <label for="updateFullname">Fullname</label>
                        <input type="text" id="updateFullname" name="fullname" class="form-control">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateAvatar">Avatar</label>
                        <div>
                            <img src="" id="avatarGetInfo" class="img-thumb" width="100" alt="">
                        </div>
                        <input type="file" id="updateAvatar" name="avatar" class="form-control mt-3" accept="image/*">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email</label>
                        <input type="text" name="email" id="updateEmail" class="form-control">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateBirthday">Birthday</label>
                        <input type="date" id="updateBirthday" name="birthday" class="form-control">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="mr-2">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="1">
                            <label class="form-check-label" for="">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input " type="radio" name="gender" value="2">
                            <label class="form-check-label" for="">Female</label>
                        </div>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateAddress">Address</label>
                        <input type="text" id="updateAddress" name="address" class="form-control">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="updatePhoneNumber">Phone Number</label>
                        <input type="text" id="updatePhoneNumber" name="phone_number" class="form-control">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="mr-2">Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0">
                            <label class="form-check-label" for=""><span
                                    class="badge badge-success">Studying</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input " type="radio" name="status" value="1">
                            <label class="form-check-label" for=""><span
                                    class="badge badge-danger">Absent</span></label>
                        </div>
                        <span class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="update_student_info_button">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

{{-- Filter by Age Modal --}}
<div class="modal fade" id="filterByScore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter By Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET">
                <div class="modal-body">
                    <div class="form-inline">
                        <input type="text" name="scoreMin" class="form-control mb-2 mr-sm-2" placeholder="From">
                        <input type="text" name="scoreMax" class="form-control mb-2 mr-sm-2" placeholder="To">
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Filter by age --}}
<div class="modal fade" id="filterByAge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter By Age</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET">
                <div class="modal-body">
                    <div class="form-inline">
                        <input type="text" name="ageMin" class="form-control mb-2 mr-sm-2" placeholder="From">
                        <input type="text" name="ageMax" class="form-control mb-2 mr-sm-2" placeholder="To">
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Filter By Type Of Phone Number --}}
<div class="modal fade" id="filterByPhoneNumberType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter By Type Of Phone Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="typeOfPhoneNumber">Type</label>
                        <select name="typeOfPhoneNumber" id="typeOfPhoneNumber" class="form-control">
                            <option>Choose Type</option>
                            <option value="viettel">Viettel</option>
                            <option value="mobiphone">Mobiphone</option>
                            <option value="vinaphone">Vinaphone</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Filter by Status Studying --}}
<div class="modal fade" id="filterByStatusStudying" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter By Status Studying</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="typeOfStatusStudying">Type</label>
                        <select name="typeOfStatusStudying" id="typeOfStatusStudying" class="form-control">
                            <option>Choose Type</option>
                            <option value="studiedAllSubjects">Studied all subjects</option>
                            <option value="notStudiedAllSubjects">Not studied all subjects</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
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
@stack('scripts')

</body>

</html>
