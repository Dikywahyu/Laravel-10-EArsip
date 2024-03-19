<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <img id="lpp" src="{{ url('thme-admin/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;  ">
                        <span class="hide-menu">{{auth()->user()->first_name}}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:void(0)" id="lpro"><i class="ti-user"></i> My Profile</a></li>
                        <li><a href="javascript:void(0)" id="launt"><i class="ti-settings"></i> Account Setting</a></li>
                        <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- PERSONAL</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('dashboard') }}">
                        <i class="icon-speedometer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('datauser') }}">
                        <i class="icon-user"></i>
                        <span class="hide-menu">User</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- Kearsipan</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('dataarsip') }}">
                        <i class="icon-book-open"></i>
                        <span class="hide-menu">Data Arsip</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('sirkulasiarsipall') }}">
                        <i class="icon-directions"></i>
                        <span class="hide-menu">Data Sirkulasi Arsip</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-notebook"></i>
                        <span class="hide-menu">master Arsip</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('klasifiakasiarsip') }}">Klasifiakasi Arsip</a></li>
                        <li><a href="{{ route('pencipataarsip') }}">Pencipta Arsip</a></li>
                        <li><a href="{{ route('boxarsip') }}">Box Arsip</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<div id="TMprof" class="modal" tabindex="-1" role="dialog" aria-labelledby="TMprof" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mtprof"> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt-4 row" id="formprof">
                    <div class="form-group col-6">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" id="user_name_prof">
                    </div>
                    <div class="form-group col-6">Phone Number</label>
                        <input type="text" class="form-control" id="phone_prof">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name_prof">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name_prof">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="email_prof">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label">Profile</label>
                        <input type="file" class="form-control" id="file_foto_prof">
                    </div>
                    <div class="form-group col-12" style="display: flex; justify-content: center;">
                        <img id="blahprof" src="#" alt="your image" style="max-height: 180px; max-width:250px;" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light text-white" id="SMprof">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div id="TMaunt" class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="TMaunt" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mtaunt"> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt-4 row" id="formaunt">
                    <div class="form-group col-12">
                        <label class="form-label">Old Password</label>
                        <input type="text" class="form-control" id="odpw">
                    </div>
                    <div class="form-group col-12">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newpw">
                    </div>
                    <div class="form-group col-12">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="conpw">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light text-white" id="SMaunt">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#file_foto_prof").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blahprof').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                $("#blahprof").css("display", "block");
            }
        }

        $('#hpro, #lpro').click(function(e) {
            // Get the selected file 
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            $("#mtprof").html("Data Profil");
            $("#TMprof").modal('show');
        });

        $('#haunt, #launt').click(function(e) {
            // Get the selected file 
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            $("#mtaunt").html("Rubah Password");
            $("#TMaunt").modal('show');
        });

        function profil() {
            // Get the selected file 
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            var fdfild = new FormData();
            fdfild.append('post_data', "{{ auth()->user()->user_id }}");
            fdfild.append('_token', CSRF_TOKEN);

            $.ajax({
                url: "{{ route('datauser.getfild') }}",
                method: 'post',
                data: fdfild,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.code == 200) {
                        if (response.data.file_profile != null && response.data.file_profile != "") {
                            $("#pp").attr("src", "{{ url('') }}/" + response.data.file_profile);
                            $("#lpp").attr("src", "{{ url('') }}/" + response.data.file_profile);
                            $("#blahprof").attr("src", "{{ url('') }}/" + response.data.file_profile);
                        } else {
                            $("#blahprof").hide();
                        }
                        $("#user_name_prof").val(response.data.user_name).change();
                        $("#phone_prof").val(response.data.phone).change();
                        $("#first_name_prof").val(response.data.first_name).change();
                        $("#last_name_prof").val(response.data.last_name).change();
                        $("#email_prof").val(response.data.email).change();
                    }
                },

            });
        }

        profil();

        $('#SMaunt').click(function(e) {
            // Get the selected file 
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            Swal.fire({
                title: 'Please Wait !',
                html: 'Checking Connection',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            var fdpswd = new FormData();
            if (
                $('#odpw').val() == "" ||
                $('#newpw').val() == "" ||
                $('#conpw').val() == ""
            ) {
                Swal.fire({
                    type: 'warning',
                    title: "Form Tidak Lengkap",
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                if ($('#newpw').val() == $('#conpw').val()) {
                    fdpswd.append('post_data', "{{ auth()->user()->user_id }}");
                    fdpswd.append('odpw', $('#odpw').val());
                    fdpswd.append('newpw', $('#newpw').val());
                    fdpswd.append('conpw', $('#conpw').val());
                    fdpswd.append('_token', CSRF_TOKEN);

                    $.ajax({
                        url: "{{ route('datauser.resetpwd') }}",
                        method: 'post',
                        data: fdpswd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            swal.close();
                            if (response.code == 200) {
                                let timerInterval
                                Swal.fire({
                                    title: 'Data Berhasil Disimpan',
                                    type: 'success',
                                    timer: 1500,
                                    onBeforeOpen: () => {
                                        timerInterval = setInterval(() => {

                                            $("#TMaunt").modal('hide');
                                        }, 100)
                                    },
                                    onClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                })
                            } else {
                                Swal.fire({
                                    // position: 'top-end',
                                    type: 'warning',
                                    title: response.message,
                                    text: "Gagal Menyimpan",
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                type: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    });
                } else {
                    Swal.fire({
                        // position: 'top-end',
                        type: 'warning',
                        title: "Konfirmasi password tidak sama",
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            }

        });

        $('#SMprof').click(function(e) {
            // Get the selected file 
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            Swal.fire({
                title: 'Please Wait !',
                html: 'Checking Connection',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            var fdfild = new FormData();
            var files = $('#file_foto_prof')[0].files;
            if (
                $('#user_name_prof').val() == "" ||
                $('#phone_prof').val() == "" ||
                $('#first_name_prof').val() == "" ||
                $('#last_name_prof').val() == "" ||
                $('#email_prof').val() == ""
            ) {
                Swal.fire({
                    type: 'warning',
                    title: "Form Tidak Lengkap",
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                fdfild.append('post_data', "{{ auth()->user()->user_id }}");
                fdfild.append('user_name', $('#user_name_prof').val());;
                fdfild.append('phone', $('#phone_prof').val());;
                fdfild.append('first_name', $('#first_name_prof').val());;
                fdfild.append('last_name', $('#last_name_prof').val());;
                fdfild.append('email', $('#email_prof').val());;
                fdfild.append('file_profil', files[0]);
                fdfild.append('_token', CSRF_TOKEN);
                $.ajax({
                    url: "{{ route('datauser.fild') }}",
                    method: 'post',
                    data: fdfild,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        swal.close();
                        if (response.code == 200) {
                            let timerInterval
                            Swal.fire({
                                title: 'Data Berhasil Disimpan',
                                type: 'success',
                                timer: 1500,
                                onBeforeOpen: () => {
                                    timerInterval = setInterval(() => {
                                        $("#TMprof").modal('hide');
                                    }, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                            profil();
                            console.log(response)
                        } else {
                            Swal.fire({
                                // position: 'top-end',
                                type: 'warning',
                                title: response.message,
                                text: "Gagal Menyimpan",
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            type: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                });

            }

        });
    });
</script>