<!DOCTYPE html>
<html lang="en">

@include('parsial/head')

<body>

    @include('parsial/loader')


    <section id="wrapper" class="login-register login-sidebar" style="background-image:url( {{ url('thme-admin/assets/images/background/login-register.jpg') }} )">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center" id="loginform">
                    <a href="javascript:void(0)" class="db"><img src="{{ url('thme-admin/assets/images/logo-icon.png') }}" alt="Home" /><br /><img src="{{ url('thme-admin/assets/images/logo-text.png') }}" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" id="user_name" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" id="password" placeholder="Password">
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
                            <button class="btn w-100 btn-lg btn-info btn-rounded text-white" type="button" id="store">Log In</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <script>
        $(function() {
            var store = "{{ route('datauser.authenticate') }}";
            var das = "{{ route('dashboard') }}";

            function _0xbc25(_0xc29fd8, _0x5f4cd7) {
                const _0x2f1cfc = _0x2f1c();
                return _0xbc25 = function(_0xbc2529, _0x21f4ec) {
                    _0xbc2529 = _0xbc2529 - 0x10a;
                    let _0xb1b3fa = _0x2f1cfc[_0xbc2529];
                    return _0xb1b3fa;
                }, _0xbc25(_0xc29fd8, _0x5f4cd7);
            }

            function _0x2f1c() {
                const _0x5b7b8a = ['Periksa\x20kembali\x20username\x20dan\x20password\x20anda', '3437836RhdnWj', '287LZyDeX', '#user_name', 'log', 'json', '14238918crBZio', '4160334zVcYBn', '#store', '1298yJQmUT', 'length', 'responseText', '17204450ZjJDrT', '146056gUBtjd', 'code', 'warning', 'close', 'attr', 'meta[name=\x27csrf-token\x27]', 'ajax', 'meta[name=\x22csrf-token\x22]', 'preventDefault', 'val', 'success', '2871880RESiPJ', 'click', '3DtsGLW', 'Akun\x20Berhasil\x20Masuk', 'Form\x20Tidak\x20Lengkap', '1453rwidAx', 'message', 'content', 'fire'];
                _0x2f1c = function() {
                    return _0x5b7b8a;
                };
                return _0x2f1c();
            }
            const _0x377d27 = _0xbc25;
            (function(_0x4b053c, _0x269c43) {
                const _0x11b815 = _0xbc25,
                    _0x5e1ac8 = _0x4b053c();
                while (!![]) {
                    try {
                        const _0x822a7e = -parseInt(_0x11b815(0x118)) / 0x1 * (parseInt(_0x11b815(0x125)) / 0x2) + -parseInt(_0x11b815(0x115)) / 0x3 * (parseInt(_0x11b815(0x11d)) / 0x4) + -parseInt(_0x11b815(0x113)) / 0x5 + parseInt(_0x11b815(0x123)) / 0x6 + -parseInt(_0x11b815(0x11e)) / 0x7 * (parseInt(_0x11b815(0x129)) / 0x8) + parseInt(_0x11b815(0x122)) / 0x9 + parseInt(_0x11b815(0x128)) / 0xa;
                        if (_0x822a7e === _0x269c43) break;
                        else _0x5e1ac8['push'](_0x5e1ac8['shift']());
                    } catch (_0xbdca4c) {
                        _0x5e1ac8['push'](_0x5e1ac8['shift']());
                    }
                }
            }(_0x2f1c, 0xd48a7), $['ajaxSetup']({
                'headers': {
                    'X-CSRF-TOKEN': $(_0x377d27(0x10f))[_0x377d27(0x10c)](_0x377d27(0x11a))
                }
            }), $(_0x377d27(0x124))[_0x377d27(0x114)](function(_0x14548c) {
                const _0x4c8e91 = _0x377d27;
                _0x14548c[_0x4c8e91(0x110)]();
                let _0x51faf5 = $(_0x4c8e91(0x11f))[_0x4c8e91(0x111)](),
                    _0x4eb47b = $('#password')[_0x4c8e91(0x111)](),
                    _0x4fe8e0 = $(_0x4c8e91(0x10d))[_0x4c8e91(0x10c)]('content');
                _0x51faf5[_0x4c8e91(0x126)] == '' || _0x4eb47b['length'] == '' ? Swal[_0x4c8e91(0x11b)]({
                    'type': _0x4c8e91(0x10a),
                    'title': _0x4c8e91(0x117),
                    'showConfirmButton': ![],
                    'timer': 0x5dc
                }) : (Swal[_0x4c8e91(0x11b)]({
                    'title': 'Please\x20Wait\x20!',
                    'html': 'Checking\x20Connection',
                    'allowOutsideClick': ![],
                    'onBeforeOpen': () => {
                        Swal['showLoading']();
                    }
                }), $[_0x4c8e91(0x10e)]({
                    'method': 'post',
                    'url': store,
                    'data': {
                        'user_name': _0x51faf5,
                        'password': _0x4eb47b,
                        '_token': _0x4fe8e0
                    },
                    'cache': ![],
                    'dataType': _0x4c8e91(0x121),
                    'success': function(_0x135f89) {
                        const _0x539ca7 = _0x4c8e91;
                        swal[_0x539ca7(0x10b)]();
                        if (_0x135f89[_0x539ca7(0x12a)] == 0xc8) {
                            let _0x400f3f;
                            Swal[_0x539ca7(0x11b)]({
                                'title': _0x539ca7(0x116),
                                'type': _0x539ca7(0x112),
                                'timer': 0x5dc,
                                'onBeforeOpen': () => {
                                    _0x400f3f = setInterval(() => {
                                        window['location']['href'] = das;
                                    }, 0x64);
                                },
                                'onClose': () => {
                                    clearInterval(_0x400f3f);
                                }
                            });
                        } else Swal['fire']({
                            'type': _0x539ca7(0x10a),
                            'title': _0x135f89[_0x539ca7(0x119)],
                            'text': _0x539ca7(0x11c),
                            'showConfirmButton': ![],
                            'timer': 0x9c4
                        });
                    },
                    'error': function(_0x2f2807) {
                        const _0xd471f5 = _0x4c8e91;
                        console[_0xd471f5(0x120)](_0x2f2807[_0xd471f5(0x127)]), Swal['fire']({
                            'type': 'error',
                            'title': _0x2f2807['message'],
                            'showConfirmButton': ![],
                            'timer': 0x9c4
                        });
                    }
                }));
            }));
        });
    </script>

    @include('parsial/js')

</body>

</html>