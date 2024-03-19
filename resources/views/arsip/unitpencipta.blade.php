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
                                    <table id="datatable-main"
                                        class="display nowrap table table-hover table-striped border" cellspacing="0"
                                        width="100%">

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="MTData" class="modal" role="dialog" aria-labelledby="MTData" aria-hidden="true"
                    style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal mt-4 row" id="formdata">
                                    <input type="text" hidden class="form-control" id="id_conten">
                                    <div class="form-group col-12">
                                        <label class="form-label">Nama Unit</label>
                                        <input type="text" class="form-control" id="nama_data_unit_penciptas">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light text-white"
                                    id="store">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    $(function() {
 
                    $(".select2").select2({ 
                        dropdownParent: $("#MTData") 
                    }); 

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
              
                    var table = $('#datatable-main').DataTable({
                        responsive: true,
                        dom: 'Bfrtip',
                        lengthChange: false,
                        ajax: {
                            method: "post",
                            url: "{{route('unitarsip.show', ['user' => 'view'])}}",
                            data: {
                                    "post_data": "{{ request()->segment(count(request()->segments(1))) }}", 
                            },
                            timeout: 120000,
                            dataSrc: function(json) {
                                if (json != null) {
                                    return json
                                } else {
                                    return "";
                                }
                            }
                        },
                        sAjaxDataProp: "",
                        width: "100%",
                        order: [
                            [0, "asc"]
                        ],
                        buttons: [
                            'csv', 'excel', 'pdf', {
                                className: 'buttons-tambah',
                                text: 'Reload',
                                action: function(e, dt, node, config) {
                                    table.ajax.reload();
                                }
                            }, {
                                className: 'buttons-tambah',
                                text: 'Tambah Data',
                                action: function(e, dt, node, config) { 
                                    $("#id_conten").val("").change();
                                    document.getElementById("formdata").reset();
                                    $("#MTData").modal('show'); 
                                }
                            }
                        ], 
                        aoColumns: [
                            {
                                "mData": null,
                                "title": "No",
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Aksi",
                                "render": function(data, row, type, meta) {
                                    return '<button   title="Edit Data"  id="EditData" value="' + data.data_unit_penciptas_id + '" class="btn btn-primary waves-effect waves-light"><i class="fas fa-edit "></i></button> ' +
                                        ' <button title="Hapus Data"  id="Destroy" value="' + data.data_unit_penciptas_id + '" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>';

                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Nama Unit",
                                "render": function(data, row, type, meta) {
                                    return data.nama_data_unit_penciptas;
                                }
                            }, 
                             
                          
                        ]
                    });

                    $('#store').click(function(e) {
                        // Get the selected file 
                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                        if ($('#id_conten').val() == "") {
                            if ( $('#nama_data_unit_penciptas').val() == "") { 
                            Swal.fire({
                                // position: 'top-end',
                                type: 'warning',
                                title: "Form Belum Terisi Dengan Lengkap",
                                showConfirmButton: false,
                                timer: 2500
                            })
                            }else {
                            Swal.fire({
                                title: 'Please Wait !',
                                html: 'Checking Connection',
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                Swal.showLoading()
                                },
                            });
                            
                            var fd = new FormData();
                            fd.append('nama_data_unit_penciptas', $('#nama_data_unit_penciptas').val()); 
                            fd.append('pencipta_arsips_id', "{{ request()->segment(count(request()->segments(1))) }}"); 
                            fd.append('_token', CSRF_TOKEN);

                            $.ajax({
                                url: "{{ route('unitarsip.store') }}",
                                method: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                    success: function(response) {
                                    swal.close();
                                    if (response.code == 200) {
                                        table.ajax.reload();
                                        let timerInterval
                                        Swal.fire({
                                            title: 'Data Berhasil Disimpan',
                                            type: 'success',
                                            timer: 1500,
                                            onBeforeOpen: () => {
                                                timerInterval = setInterval(() => {
                                                    table.ajax.reload();
                                                    $("#MTData").modal('hide');
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
                            }
                        } else {
                            if ( $('#nama_data_unit_penciptas').val() == ""  ) { 
                            Swal.fire({
                                // position: 'top-end',
                                type: 'warning',
                                title: "Form Belum Terisi Dengan Lengkap",
                                showConfirmButton: false,
                                timer: 2500
                            })
                            }else {
                            Swal.fire({
                                title: 'Please Wait !',
                                html: 'Checking Connection',
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                Swal.showLoading()
                                },
                            });
                            
                            var fd = new FormData();
                            fd.append('id_conten', $('#id_conten').val()); 
                            fd.append('nama_data_unit_penciptas', $('#nama_data_unit_penciptas').val());  
                            fd.append('pencipta_arsips_id', "{{ request()->segment(count(request()->segments(1))) }}") ; 
                            fd.append('_token', CSRF_TOKEN);

                            $.ajax({
                                url: "{{ route('unitarsip.update') }}",
                                method: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                    success: function(response) {
                                    swal.close();
                                    if (response.code == 200) {
                                        table.ajax.reload();
                                        let timerInterval
                                        Swal.fire({
                                            title: 'Data Berhasil Disimpan',
                                            type: 'success',
                                            timer: 1500,
                                            onBeforeOpen: () => {
                                                timerInterval = setInterval(() => {
                                                    table.ajax.reload();
                                                    $("#MTData").modal('hide');
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
                            }
                        }


                    });
        
                    $('#datatable-main').on('click', '#EditData', function() {

                        var post_data = $(this).val();
                        let token = $("meta[name='csrf-token']").attr("content");

                        Swal.fire({
                            title: 'Edit Data?',
                            text: "Kamu akan mengubah data !",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Edit!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    method: 'post',
                                    url: "{{route('unitarsip.show','src')}}",
                                    cache: false,
                                    data: {
                                        "post_data": post_data,
                                        "_token": token
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        $("#MTData").modal('show');
                                        $("#id_conten").val(response.data.data_unit_penciptas_id).change(); 
                                        $("#nama_data_unit_penciptas").val(response.data.nama_data_unit_penciptas).change();   
                                    },
                                    error: function(response) {
                                        console.log(response);
                                    }
                                });

                            }
                        })
                    });

                    $('#datatable-main').on('click', '#Destroy', function() {

                        var post_data = $(this).val();
                        let token = $("meta[name='csrf-token']").attr("content");

                        Swal.fire({
                            title: 'Hapus Data?',
                            text: "Kamu akan menghapus data ini permanen!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Hapus!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    method: 'delete',
                                    url: "{{ route('unitarsip.destroy') }}",
                                    cache: false,
                                    data: {
                                        "post_data": post_data,
                                        "_token": token
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        Swal.close();
                                        Swal.fire({
                                            title: 'Data Berhasil Hapus',
                                            type: 'success',
                                            timer: 1500,
                                            onBeforeOpen: () => {
                                                table.ajax.reload();
                                            },

                                        })
                                        console.log(response);
                                    },
                                    error: function(response) {
                                        console.log(response);
                                    }
                                });

                                Swal.fire({
                                    title: 'Hapus Data',
                                    html: 'Harap Tunggu Proses Sedang Berjalan',
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },

                                })
                            }
                        })
                    });

                    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-tambah').addClass('btn btn-primary me-1 m-1');


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