<!DOCTYPE html>
<html lang="en">

@include('parsial/head')

<body class="skin-blue fixed-layout">
  @include('parsial/loader')
  <div id="main-wrapper">
    @include('parsial/header')
    @include('parsial/leftmenu')

    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row page-titles">
          <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ $tittle }} </h4>
          </div>
          <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
              <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">{{ $tittle }} </li>
              </ol>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive m-t-20">
                  <table id="datatable-main" class="display nowrap table table-hover table-striped border" cellspacing="0" width="100%">

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="MTData" class="modal" tabindex="-1" role="dialog" aria-labelledby="MTData" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal mt-4 row" id="formdata">
                  <input type="text" hidden class="form-control" id="id_conten">
                  <div class="form-group col-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name">
                  </div>
                  <div class="form-group col-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name">
                  </div>
                  <div class="form-group col-6">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control" id="user_name">
                  </div>
                  <div class="form-group col-6">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" id="password">
                  </div>
                  <div class="form-group col-6">
                    <label class="form-label">level</label>
                    <select class="form-control form-select" id="level">
                      <option value="">Pilih level</option>
                      <option value="Supper">Supper</option>
                      <option value="Admin Keuangan">Admin Keuangan</option>
                      <option value="Admin Prodi">Admin Prodi</option>
                      <option value="Admin Rektorad">Admin Rektorad</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label class="form-label">status</label>
                    <select class="form-control form-select" id="status">
                      <option value="Aktiv">Aktiv</option>
                      <option value="OFF">OFF</option>
                    </select>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light text-white" id="store">Simpan</button>
              </div>
            </div>
          </div>
        </div>


        <script>
          $(function() {

            var urltable = "{{route('datauser.show', ['user' => 'view'])}}";
            var store = "{{ route('datauser.store') }}";
            var update = "{{ route('datauser.update') }}";
            var src = "{{route('datauser.show','src')}}";
            var destroy = "{{ route('datauser.destroy') }}";
            var _0x16c49a = _0x210d;

            function _0x4b82() {
              var _0x3756b3 = ['buttons-tambah', 'content', '#first_name', '138148BUwnOT', 'user_name', 'Checking\x20Connection', 'append', 'Last\x20Name', 'user_id', 'formdata', '#datatable-main', '100%', '871323SWmvoU', 'show', 'Yes,\x20Edit!', 'User\x20Name', 'Please\x20Wait\x20!', 'last_name', 'excel', 'Gagal\x20Menyimpan', 'Hapus\x20Data', 'val', 'fire', 'apassword', 'querySelector', 'modal', 'message', '#last_name', 'click', 'Yes,\x20Hapus!', 'Tambah\x20Data', '_token', '\x20<button\x20title=\x22Hapus\x20Data\x22\x20\x20id=\x22Destroy\x22\x20value=\x22', '5026962AcFSou', 'log', 'attr', 'close', 'warning', 'meta[name=\x27csrf-token\x27]', '#status', '57BsLSYU', '#MTData', '\x22\x20class=\x22btn\x20btn-primary\x20waves-effect\x20waves-light\x22><i\x20class=\x22fas\x20fa-edit\x20\x22></i></button>\x20', 'id_conten', '#id_conten', 'addClass', 'success', 'Aksi', '#d33', 'code', 'post', 'hide', '#store', '1409940jutbxM', '#user_name', 'change', 'reload', 'first_name', 'Hapus\x20Data?', 'password', 'asc', 'Kamu\x20akan\x20mengubah\x20data\x20!', 'btn\x20btn-primary\x20me-1\x20m-1', 'Form\x20Belum\x20Terisi\x20Dengan\x20Lengkap', '#Destroy', 'then', '544bxCQDK', 'value', '<button\x20\x20\x20title=\x22Edit\x20Data\x22\x20\x20id=\x22EditData\x22\x20value=\x22', 'meta[name=\x22csrf-token\x22]', 'ajax', '4902849rRlOLj', '#EditData', 'level', 'First\x20Name', 'email', 'data', '2964565ZSiGUn', 'delete', '#password', 'settings', '264258olzKwZ', '#3085d6', 'showLoading', 'email_verified_at', 'json', 'ajaxSetup', '#level', 'status', '_iDisplayStart', 'Bfrtip', 'error', 'Data\x20Berhasil\x20Disimpan'];
              _0x4b82 = function() {
                return _0x3756b3;
              };
              return _0x4b82();
            }(function(_0x49af16, _0x95766e) {
              var _0x38aff9 = _0x210d,
                _0x544fdb = _0x49af16();
              while (!![]) {
                try {
                  var _0x437836 = -parseInt(_0x38aff9(0x123)) / 0x1 + -parseInt(_0x38aff9(0x14c)) / 0x2 + parseInt(_0x38aff9(0x13f)) / 0x3 * (-parseInt(_0x38aff9(0x11a)) / 0x4) + parseInt(_0x38aff9(0x164)) / 0x5 + parseInt(_0x38aff9(0x138)) / 0x6 + -parseInt(_0x38aff9(0x15e)) / 0x7 + parseInt(_0x38aff9(0x159)) / 0x8 * (parseInt(_0x38aff9(0x168)) / 0x9);
                  if (_0x437836 === _0x95766e) break;
                  else _0x544fdb['push'](_0x544fdb['shift']());
                } catch (_0x5f2192) {
                  _0x544fdb['push'](_0x544fdb['shift']());
                }
              }
            }(_0x4b82, 0x78b75), $[_0x16c49a(0x16d)]({
              'headers': {
                'X-CSRF-TOKEN': $(_0x16c49a(0x15c))[_0x16c49a(0x13a)](_0x16c49a(0x118))
              }
            }));

            function _0x210d(_0x124c6b, _0x1d036d) {
              var _0x4b82d7 = _0x4b82();
              return _0x210d = function(_0x210dd1, _0x4c8be9) {
                _0x210dd1 = _0x210dd1 - 0x118;
                var _0x22cb98 = _0x4b82d7[_0x210dd1];
                return _0x22cb98;
              }, _0x210d(_0x124c6b, _0x1d036d);
            }
            var table = $('#datatable-main')['DataTable']({
              'responsive': !![],
              'dom': _0x16c49a(0x171),
              'lengthChange': ![],
              'ajax': {
                'method': _0x16c49a(0x149),
                'url': urltable,
                'timeout': 0x1d4c0,
                'dataSrc': function(_0x14e82e) {
                  return _0x14e82e != null ? _0x14e82e : '';
                }
              },
              'sAjaxDataProp': '',
              'width': _0x16c49a(0x122),
              'order': [
                [0x0, _0x16c49a(0x153)]
              ],
              'buttons': ['csv', _0x16c49a(0x129), 'pdf', {
                'className': _0x16c49a(0x174),
                'text': 'Reload',
                'action': function(_0x4b967e, _0x2f8247, _0x378002, _0xb2b7e0) {
                  var _0x1f31b3 = _0x16c49a;
                  table[_0x1f31b3(0x15d)][_0x1f31b3(0x14f)]();
                }
              }, {
                'className': 'buttons-tambah',
                'text': _0x16c49a(0x135),
                'action': function(_0x407f8c, _0x23e33c, _0x1b79d4, _0x4be895) {
                  var _0x130a05 = _0x16c49a;
                  $(_0x130a05(0x143))[_0x130a05(0x12c)]('')[_0x130a05(0x14e)](), document['getElementById'](_0x130a05(0x120))['reset'](), $(_0x130a05(0x140))[_0x130a05(0x130)](_0x130a05(0x124));
                }
              }],
              'aoColumns': [{
                'mData': null,
                'title': 'No',
                'render': function(_0x1b3c08, _0x1df660, _0x1c5871, _0x195528) {
                  var _0x44acac = _0x16c49a;
                  return _0x195528['row'] + _0x195528[_0x44acac(0x167)][_0x44acac(0x170)] + 0x1;
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x146),
                'render': function(_0x1ca830, _0x1b4ad5, _0x58a657, _0x2337a3) {
                  var _0x354835 = _0x16c49a;
                  return _0x354835(0x15b) + _0x1ca830['user_id'] + _0x354835(0x141) + _0x354835(0x137) + _0x1ca830[_0x354835(0x11f)] + '\x22\x20class=\x22btn\x20btn-danger\x20waves-effect\x20waves-light\x22><i\x20class=\x22fas\x20fa-trash\x22></i></button>';
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x126),
                'render': function(_0x120c3e, _0x12ed3b, _0x2ee182, _0x447eae) {
                  var _0xe14de8 = _0x16c49a;
                  return _0x120c3e[_0xe14de8(0x11b)];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x161),
                'render': function(_0x4f6405, _0x532f3a, _0x20bc58, _0x453792) {
                  var _0x1bf877 = _0x16c49a;
                  return _0x4f6405[_0x1bf877(0x150)];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x11e),
                'render': function(_0xbf44f9, _0x3a5db5, _0x3e1d1a, _0x5f52ad) {
                  var _0x7982a6 = _0x16c49a;
                  return _0xbf44f9[_0x7982a6(0x128)];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x162),
                'render': function(_0x4813c8, _0xc4022b, _0x3e4bfe, _0x5a3fc2) {
                  var _0x476b98 = _0x16c49a;
                  return _0x4813c8[_0x476b98(0x162)];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x16b),
                'render': function(_0x1b705e, _0x204a10, _0x5ad0a3, _0x5ebcf5) {
                  return _0x1b705e['email_verified_at'];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x160),
                'render': function(_0x1e6033, _0x4e2c3f, _0x57368f, _0x1b80a1) {
                  return _0x1e6033['level'];
                }
              }, {
                'mData': null,
                'title': _0x16c49a(0x16f),
                'render': function(_0x25c953, _0xaf352, _0x15409e, _0x505a0f) {
                  var _0x340683 = _0x16c49a;
                  return _0x25c953[_0x340683(0x16f)];
                }
              }]
            });
            $(_0x16c49a(0x14b))[_0x16c49a(0x133)](function(_0x1da613) {
              var _0x313788 = _0x16c49a,
                _0x1a0f8b = document[_0x313788(0x12f)](_0x313788(0x15c))['getAttribute'](_0x313788(0x118));
              if ($(_0x313788(0x143))[_0x313788(0x12c)]() == '') {
                if ($(_0x313788(0x14d))[_0x313788(0x12c)]() == '' || $(_0x313788(0x119))[_0x313788(0x12c)]() == '' || $('#last_name')[_0x313788(0x12c)]() == '' || $(_0x313788(0x166))['val']() == '' || $(_0x313788(0x16e))[_0x313788(0x12c)]() == '' || $(_0x313788(0x13e))[_0x313788(0x12c)]() == '') Swal[_0x313788(0x12d)]({
                  'type': _0x313788(0x13c),
                  'title': _0x313788(0x156),
                  'showConfirmButton': ![],
                  'timer': 0x9c4
                });
                else {
                  Swal[_0x313788(0x12d)]({
                    'title': _0x313788(0x127),
                    'html': _0x313788(0x11c),
                    'allowOutsideClick': ![],
                    'onBeforeOpen': () => {
                      var _0x5da15e = _0x313788;
                      Swal[_0x5da15e(0x16a)]();
                    }
                  });
                  var _0x4b57a7 = new FormData();
                  _0x4b57a7[_0x313788(0x11d)](_0x313788(0x11b), $('#user_name')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x150), $(_0x313788(0x119))[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x128), $(_0x313788(0x132))[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x152), $('#password')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)]('level', $('#level')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x16f), $('#status')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x136), _0x1a0f8b), $[_0x313788(0x15d)]({
                    'url': store,
                    'method': _0x313788(0x149),
                    'data': _0x4b57a7,
                    'contentType': ![],
                    'processData': ![],
                    'dataType': _0x313788(0x16c),
                    'success': function(_0x72f0c5) {
                      var _0x16b7f4 = _0x313788;
                      swal[_0x16b7f4(0x13b)]();
                      if (_0x72f0c5['code'] == 0xc8) {
                        table['ajax'][_0x16b7f4(0x14f)]();
                        let _0x1fe657;
                        Swal['fire']({
                          'title': _0x16b7f4(0x173),
                          'type': 'success',
                          'timer': 0x5dc,
                          'onBeforeOpen': () => {
                            _0x1fe657 = setInterval(() => {
                              var _0x46ee4c = _0x210d;
                              table[_0x46ee4c(0x15d)]['reload'](), $(_0x46ee4c(0x140))[_0x46ee4c(0x130)](_0x46ee4c(0x14a));
                            }, 0x64);
                          },
                          'onClose': () => {
                            clearInterval(_0x1fe657);
                          }
                        });
                      } else Swal[_0x16b7f4(0x12d)]({
                        'type': 'warning',
                        'title': _0x72f0c5[_0x16b7f4(0x131)],
                        'text': _0x16b7f4(0x12a),
                        'showConfirmButton': ![],
                        'timer': 0x9c4
                      });
                    },
                    'error': function(_0x40ef30) {
                      var _0x36f029 = _0x313788;
                      Swal[_0x36f029(0x12d)]({
                        'type': 'error',
                        'title': _0x40ef30[_0x36f029(0x131)],
                        'showConfirmButton': ![],
                        'timer': 0x9c4
                      });
                    }
                  });
                }
              } else {
                if ($(_0x313788(0x143))[_0x313788(0x12c)]() == '' || $(_0x313788(0x14d))['val']() == '' || $(_0x313788(0x119))[_0x313788(0x12c)]() == '' || $(_0x313788(0x132))[_0x313788(0x12c)]() == '' || $(_0x313788(0x166))['val']() == '' || $(_0x313788(0x16e))[_0x313788(0x12c)]() == '' || $(_0x313788(0x13e))[_0x313788(0x12c)]() == '') Swal['fire']({
                  'type': _0x313788(0x13c),
                  'title': _0x313788(0x156),
                  'showConfirmButton': ![],
                  'timer': 0x9c4
                });
                else {
                  Swal[_0x313788(0x12d)]({
                    'title': 'Please\x20Wait\x20!',
                    'html': 'Checking\x20Connection',
                    'allowOutsideClick': ![],
                    'onBeforeOpen': () => {
                      Swal['showLoading']();
                    }
                  });
                  var _0x4b57a7 = new FormData();
                  _0x4b57a7[_0x313788(0x11d)](_0x313788(0x142), $(_0x313788(0x143))[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)]('user_name', $(_0x313788(0x14d))[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)]('first_name', $('#first_name')['val']()), _0x4b57a7[_0x313788(0x11d)]('last_name', $('#last_name')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x152), $(_0x313788(0x166))['val']()), _0x4b57a7['append'](_0x313788(0x160), $(_0x313788(0x16e))[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x16f), $('#status')[_0x313788(0x12c)]()), _0x4b57a7[_0x313788(0x11d)](_0x313788(0x136), _0x1a0f8b), $[_0x313788(0x15d)]({
                    'url': update,
                    'method': _0x313788(0x149),
                    'data': _0x4b57a7,
                    'contentType': ![],
                    'processData': ![],
                    'dataType': _0x313788(0x16c),
                    'success': function(_0x5a9ee0) {
                      var _0x467d40 = _0x313788;
                      swal[_0x467d40(0x13b)]();
                      if (_0x5a9ee0[_0x467d40(0x148)] == 0xc8) {
                        table[_0x467d40(0x15d)][_0x467d40(0x14f)]();
                        let _0x12e334;
                        Swal['fire']({
                          'title': _0x467d40(0x173),
                          'type': _0x467d40(0x145),
                          'timer': 0x5dc,
                          'onBeforeOpen': () => {
                            _0x12e334 = setInterval(() => {
                              var _0x40064f = _0x210d;
                              table['ajax']['reload'](), $(_0x40064f(0x140))[_0x40064f(0x130)](_0x40064f(0x14a));
                            }, 0x64);
                          },
                          'onClose': () => {
                            clearInterval(_0x12e334);
                          }
                        });
                      } else Swal[_0x467d40(0x12d)]({
                        'type': _0x467d40(0x13c),
                        'title': _0x5a9ee0[_0x467d40(0x131)],
                        'text': 'Gagal\x20Menyimpan',
                        'showConfirmButton': ![],
                        'timer': 0x9c4
                      });
                    },
                    'error': function(_0x2ffb1c) {
                      var _0x3f8594 = _0x313788;
                      Swal[_0x3f8594(0x12d)]({
                        'type': _0x3f8594(0x172),
                        'title': _0x2ffb1c[_0x3f8594(0x131)],
                        'showConfirmButton': ![],
                        'timer': 0x9c4
                      });
                    }
                  });
                }
              }
            }), $(_0x16c49a(0x121))['on'](_0x16c49a(0x133), _0x16c49a(0x15f), function() {
              var _0x21f0df = _0x16c49a,
                _0x2359ef = $(this)[_0x21f0df(0x12c)]();
              let _0x2c9f61 = $(_0x21f0df(0x13d))[_0x21f0df(0x13a)](_0x21f0df(0x118));
              Swal['fire']({
                'title': 'Edit\x20Data?',
                'text': _0x21f0df(0x154),
                'type': _0x21f0df(0x13c),
                'showCancelButton': !![],
                'confirmButtonColor': _0x21f0df(0x169),
                'cancelButtonColor': _0x21f0df(0x147),
                'confirmButtonText': _0x21f0df(0x125)
              })['then'](_0x18eaa4 => {
                var _0x17ee9f = _0x21f0df;
                _0x18eaa4[_0x17ee9f(0x15a)] && $[_0x17ee9f(0x15d)]({
                  'method': 'post',
                  'url': src,
                  'cache': ![],
                  'data': {
                    'post_data': _0x2359ef,
                    '_token': _0x2c9f61
                  },
                  'dataType': 'json',
                  'success': function(_0x521509) {
                    var _0x40e75c = _0x17ee9f;
                    $(_0x40e75c(0x140))[_0x40e75c(0x130)](_0x40e75c(0x124)), $(_0x40e75c(0x143))[_0x40e75c(0x12c)](_0x521509[_0x40e75c(0x163)][_0x40e75c(0x11f)])['change'](), $(_0x40e75c(0x14d))['val'](_0x521509[_0x40e75c(0x163)][_0x40e75c(0x11b)])['change'](), $(_0x40e75c(0x119))['val'](_0x521509['data'][_0x40e75c(0x150)])[_0x40e75c(0x14e)](), $(_0x40e75c(0x132))[_0x40e75c(0x12c)](_0x521509[_0x40e75c(0x163)]['last_name'])[_0x40e75c(0x14e)](), $('#password')[_0x40e75c(0x12c)](_0x521509[_0x40e75c(0x163)][_0x40e75c(0x12e)])[_0x40e75c(0x14e)](), $('#level')[_0x40e75c(0x12c)](_0x521509[_0x40e75c(0x163)][_0x40e75c(0x160)])[_0x40e75c(0x14e)](), $(_0x40e75c(0x13e))['val'](_0x521509[_0x40e75c(0x163)]['status'])[_0x40e75c(0x14e)]();
                  },
                  'error': function(_0xd05b2d) {
                    var _0x5df831 = _0x17ee9f;
                    console[_0x5df831(0x139)](_0xd05b2d);
                  }
                });
              });
            }), $(_0x16c49a(0x121))['on'](_0x16c49a(0x133), _0x16c49a(0x157), function() {
              var _0x21d5b8 = _0x16c49a,
                _0x28f01c = $(this)[_0x21d5b8(0x12c)]();
              let _0x2b1373 = $('meta[name=\x27csrf-token\x27]')[_0x21d5b8(0x13a)]('content');
              Swal[_0x21d5b8(0x12d)]({
                'title': _0x21d5b8(0x151),
                'text': 'Kamu\x20akan\x20menghapus\x20data\x20ini\x20permanen!',
                'type': _0x21d5b8(0x13c),
                'showCancelButton': !![],
                'confirmButtonColor': '#3085d6',
                'cancelButtonColor': '#d33',
                'confirmButtonText': _0x21d5b8(0x134)
              })[_0x21d5b8(0x158)](_0x369eb6 => {
                var _0x52a92f = _0x21d5b8;
                _0x369eb6['value'] && ($[_0x52a92f(0x15d)]({
                  'method': _0x52a92f(0x165),
                  'url': destroy,
                  'cache': ![],
                  'data': {
                    'post_data': _0x28f01c,
                    '_token': _0x2b1373
                  },
                  'dataType': _0x52a92f(0x16c),
                  'success': function(_0x1bdb6a) {
                    var _0x52b3d5 = _0x52a92f;
                    Swal[_0x52b3d5(0x13b)](), Swal[_0x52b3d5(0x12d)]({
                      'title': 'Data\x20Berhasil\x20Hapus',
                      'type': _0x52b3d5(0x145),
                      'timer': 0x5dc,
                      'onBeforeOpen': () => {
                        var _0x5f1d45 = _0x52b3d5;
                        table[_0x5f1d45(0x15d)][_0x5f1d45(0x14f)]();
                      }
                    }), console[_0x52b3d5(0x139)](_0x1bdb6a);
                  },
                  'error': function(_0x5d0b32) {
                    var _0x2ea172 = _0x52a92f;
                    console[_0x2ea172(0x139)](_0x5d0b32);
                  }
                }), Swal[_0x52a92f(0x12d)]({
                  'title': _0x52a92f(0x12b),
                  'html': 'Harap\x20Tunggu\x20Proses\x20Sedang\x20Berjalan',
                  'onBeforeOpen': () => {
                    Swal['showLoading']();
                  }
                }));
              });
            }), $('.buttons-copy,\x20.buttons-csv,\x20.buttons-print,\x20.buttons-pdf,\x20.buttons-excel,\x20.buttons-tambah')[_0x16c49a(0x144)](_0x16c49a(0x155));

          });
        </script>


        @include('parsial/rightmenu')

      </div>

    </div>

    @include('parsial/footer')

  </div>

  @include('parsial/js')
</body>

</html>