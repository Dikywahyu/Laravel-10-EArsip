<!DOCTYPE html>
<html lang="en">

@include('parsial/head')

<body>

    @include('parsial/loader')


    <section id="wrapper" class="login-register login-sidebar" style="background-image:url( {{ url('thme-admin/assets/images/background/login-register.jpg') }} )">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center" id="loginform">
                    <a href="javascript:void(0)" class="db"><img
                            src="{{ url('thme-admin/assets/images/logo-icon.png') }}" alt="Home" /><br /><img
                            src="{{ url('thme-admin/assets/images/logo-text.png') }}" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" id="user_name" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" id="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">Remember me</label>
                                </div>
                                <div class="ms-auto">
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn w-100 btn-lg btn-info btn-rounded text-white" type="button"
                                id="store">Log In</button>
                        </div>
                    </div> 
                </form>
                 
            </div>
        </div>
    </section>

    <script>
        $(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#store').click(function(e) {
                e.preventDefault();

                //define variable
                let user_name = $('#user_name').val();
                let password = $('#password').val();
                let token = $("meta[name='csrf-token']").attr("content");

                if (user_name.length == "" || password.length == "") {
                    Swal.fire({
                        // position: 'top-end',
                        type: 'warning',
                        title: 'Form Tidak Lengkap',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'Checking Connection',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    $.ajax({
                        method: 'post',
                        url: "{{ route('datauser.authenticate') }}",
                        data: {
                            "user_name": user_name,
                            "password": password,
                            "_token": token
                        },
                        cache: false,
                        dataType: "json",
                        success: function(response) {
                            swal.close();
                            if (response.code == 200) {
                                let timerInterval
                                Swal.fire({
                                    title: 'Akun Berhasil Masuk',
                                    type: 'success',
                                    timer: 1500,
                                    onBeforeOpen: () => {
                                        timerInterval = setInterval(() => {
                                            window.location.href = "{{ route('dashboard') }}";
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
                                    text: "Periksa kembali username dan password anda",
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }
                        },
                        error: function(response) {
                            console.log(response.responseText);
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

    @include('parsial/js')

</body>

</html>