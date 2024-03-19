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

                <div id="MTData" class="modal" role="dialog" aria-labelledby="MTData" aria-hidden="true" style="display: none;">
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
                                        <label class="form-label">Code Boxes</label>
                                        <input type="text" class="form-control" id="code_boxes">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Nama Boxes</label>
                                        <input type="text" class="form-control" id="nama_boxes">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Lokasi Boxes</label>
                                        <input type="text" class="form-control" id="lokasi_boxes">
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

                <div id="qrCode" class="modal bs-example-modal-sm" role="dialog" aria-labelledby="qrCode" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body" id="dataqr" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">

                                <div id="qr-code-container" style="display: flex; "></div>
                                <span id="nama-box" style="display: flex;"></span>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light text-white" id="printButton">Print</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    $(function() {

                        var qr_code_data;

                        $("#printButton").click(function() {
                            // Tunggu hingga elemen #dataqr dimuat dan ditampilkan di halaman
                            setTimeout(function() {
                                html2canvas($("#dataqr")[0]).then(function(canvas) {
                                    var imgData = canvas.toDataURL('image/png');
                                    var link = document.createElement('a');
                                    link.download = 'qr_code ' + qr_code_data + '.png';
                                    link.href = imgData;
                                    link.click();
                                });
                            }, 100); // Waktu tunggu 100ms sebelum menjalankan html2canvas
                        });

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
                                url: "{{route('boxarsip.show', ['user' => 'view'])}}",
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
                            aoColumns: [{
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
                                        return '<button   title="Edit Data"  id="EditData" value="' + data.data_boxes_id + '" class="btn btn-primary waves-effect waves-light"><i class="fas fa-edit "></i></button> ' +
                                            ' <button title="Hapus Data"  id="Destroy" value="' + data.data_boxes_id + '" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>' +
                                            ' <button title="QR Data"  id="QR" value="' + data.data_boxes_id + '" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-qrcode-scan"></i></button>' +
                                            ' <a title="Isi Box" href="dataisibox/' + data.data_boxes_id + '" target="_blank" class="btn btn-info waves-effect waves-light"><i class="fas fa-search"></i></a>';

                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Code",
                                    "render": function(data, row, type, meta) {
                                        return data.code_boxes;
                                    }
                                },

                                {
                                    "mData": null,
                                    "title": "Name",
                                    "render": function(data, row, type, meta) {
                                        return data.nama_boxes;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Lokasi",
                                    "render": function(data, row, type, meta) {
                                        return data.lokasi_boxes;
                                    }
                                },

                            ]
                        });

                        $('#store').click(function(e) {
                            // Get the selected file 
                            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                            if ($('#id_conten').val() == "") {
                                if (
                                    $('#code_boxes').val() == "" ||
                                    $('#lokasi_boxes').val() == "" ||
                                    $('#nama_boxes').val() == ""
                                ) {
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'warning',
                                        title: "Form Belum Terisi Dengan Lengkap",
                                        showConfirmButton: false,
                                        timer: 2500
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

                                    var fd = new FormData();
                                    fd.append('code_boxes', $('#code_boxes').val());
                                    fd.append('nama_boxes', $('#nama_boxes').val());
                                    fd.append('lokasi_boxes', $('#lokasi_boxes').val());
                                    fd.append('_token', CSRF_TOKEN);

                                    $.ajax({
                                        url: "{{ route('boxarsip.store') }}",
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
                                if (
                                    $('#code_boxes').val() == "" ||
                                    $('#nama_boxes').val() == ""
                                ) {
                                    Swal.fire({
                                        // position: 'top-end',
                                        type: 'warning',
                                        title: "Form Belum Terisi Dengan Lengkap",
                                        showConfirmButton: false,
                                        timer: 2500
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

                                    var fd = new FormData();
                                    fd.append('id_conten', $('#id_conten').val());
                                    fd.append('code_boxes', $('#code_boxes').val());
                                    fd.append('nama_boxes', $('#nama_boxes').val());
                                    fd.append('lokasi_boxes', $('#lokasi_boxes').val());
                                    fd.append('_token', CSRF_TOKEN);

                                    $.ajax({
                                        url: "{{ route('boxarsip.update') }}",
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
                                        url: "{{route('boxarsip.show','src')}}",
                                        cache: false,
                                        data: {
                                            "post_data": post_data,
                                            "_token": token
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            $("#MTData").modal('show');
                                            $("#id_conten").val(response.data.data_boxes_id).change();
                                            $("#code_boxes").val(response.data.code_boxes).change();
                                            $("#nama_boxes").val(response.data.nama_boxes).change();
                                        },
                                        error: function(response) {
                                            console.log(response);
                                        }
                                    });

                                }
                            })
                        });


                        $('#datatable-main').on('click', '#QR', function() {

                            var post_data = $(this).val();
                            let token = $("meta[name='csrf-token']").attr("content");

                            Swal.fire({
                                title: 'QR Data?',
                                text: "Kamu akan melihat data !",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        method: 'get',
                                        url: "{{route('generateQRCode')}}",
                                        cache: false,
                                        data: {
                                            "url": post_data,
                                            "_token": token
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            $("#qrCode").modal('show');
                                            $('#qr-code-container').empty();
                                            $('#qr-code-container').append(response.qr_code);

                                            $('#nama-box').html(post_data);
                                            qr_code_data = post_data;
                                            console.log(response);
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
                                        url: "{{ route('boxarsip.destroy') }}",
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