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
                                        <label class="form-label">Nomor Arsip</label>
                                        <input type="text" class="form-control" id="nomor_arsip">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Tanggal Penciptaan</label>
                                        <input type="date" class="form-control" id="tgl_arsip">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Pencipta</label>
                                        <select class="select2 form-control form-select" id="pencipta_arsips_id" style="width: 100%; height: 36px">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Unit Pengolah</label>
                                        <select class="select2 form-control form-select" id="data_unit_penciptas_id" style="width: 100%; height: 36px">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Kode Klasifikasi</label>
                                        <select class="select2 form-control form-select" id="klasifiakasi_arsips_id" style="width: 100%; height: 36px">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Box Arsip</label>
                                        <select class="select2 form-control form-select" id="data_boxes_id" style="width: 100%; height: 36px">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="form-label">Jumlah Arsip</label>
                                        <input type="number" class="form-control" id="jumlah_arsip">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="form-label">Penerima</label>
                                        <input type="text" class="form-control" id="penerima_arsip">
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="form-label">Jumlah Halaman</label>
                                        <input type="number" class="form-control" id="lembar_arsip">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Jenis Arsip</label>
                                        <select class="form-control form-select" id="level">
                                            <option value="">Pilih Jenis</option>
                                            <option value="Asli">Asli</option>
                                            <option value="Salinan">Salinan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="form-label">Keterangan Arsip</label>
                                        <textarea class="form-control" rows="5" id="ket_arsip"></textarea>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">File Arsip</label>
                                        <input type="file" class="form-control" id="file_arsip">
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

                        $(".select2, #pencipta_arsips_id, #data_unit_penciptas_id, #klasifiakasi_arsips_id, #data_boxes_id").select2({
                            dropdownParent: $("#MTData")
                        });

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var boxarsip = $.ajax({
                            url: "{{route('boxarsip.show', ['user' => 'view'])}}",
                            type: "post",
                            success: function(response) {
                                $.each(response, function(index, item) {
                                    $('#data_boxes_id').append('<option value="' + item.data_boxes_id + '">' + item.code_boxes + " " + item.nama_boxes + '</option>');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                        var pencipta = $.ajax({
                            url: "{{route('pencipataarsip.show', ['user' => 'view'])}}",
                            type: "post",
                            success: function(response) {
                                $.each(response, function(index, item) {
                                    $('#pencipta_arsips_id').append('<option value="' + item.pencipta_arsips_id + '">' + item.nama_pencipta_arsips + '</option>');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                        var klasifiakasiarsip = $.ajax({
                            url: "{{route('klasifiakasiarsip.show', ['user' => 'view'])}}",
                            type: "post",
                            success: function(response) {
                                $.each(response, function(index, item) {
                                    $('#klasifiakasi_arsips_id').append('<option value="' + item.klasifiakasi_arsips_id + '">' + item.main_code + " " + item.arsip_nama + '</option>');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                        $('#pencipta_arsips_id').change(function() {
                            var selectedValue = $(this).val();
                            if (selectedValue) {
                                $.ajax({
                                    url: "{{route('unitarsip.show', ['user' => 'view'])}}",
                                    data: {
                                        "post_data": selectedValue,
                                    },
                                    type: "post",
                                    success: function(response) {
                                        $.each(response, function(index, item) {
                                            $('#data_unit_penciptas_id').append('<option value="' + item.data_unit_penciptas_id + '">' + item.nama_data_unit_penciptas + '</option>');
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });
                            }

                        });

                        var table = $('#datatable-main').DataTable({
                            responsive: true,
                            dom: 'Bfrtip',
                            lengthChange: false,
                            ajax: {
                                method: "post",
                                url: "{{route('dataarsip.show', ['user' => 'view'])}}",
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
                                        $("#nomor_arsip").val("").change();
                                        $("#tgl_arsip").val("").change();
                                        $("#pencipta_arsips_id").val("").change();
                                        $("#data_unit_penciptas_id").val("").change();
                                        $("#klasifiakasi_arsips_id").val("").change();
                                        $("#data_boxes_id").val("").change();
                                        $("#jumlah_arsip").val("").change();
                                        $("#level").val("").change();
                                        $("#ket_arsip").val("").change();
                                        $("#file_arsip").val("").change();
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
                                        if (data.stok_arsip > 0) {
                                            return '<button   title="Edit Data"  id="EditData" value="' + data.data_arsips_id + '" class="btn btn-primary waves-effect waves-light"><i class="fas fa-edit "></i></button> ' +
                                                ' <button title="Hapus Data"  id="Destroy" value="' + data.data_arsips_id + '" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>' +
                                                ' <a href="sirkulasiarsip/' + data.data_arsips_id + '" target="_blank" class="btn btn-success waves-effect waves-light"><i class="fas fa-plus"></i> Pinjam</a>';
                                        } else {
                                            return '<button   title="Edit Data"  id="EditData" value="' + data.data_arsips_id + '" class="btn btn-primary waves-effect waves-light"><i class="fas fa-edit "></i></button> ' +
                                                ' <button title="Hapus Data"  id="Destroy" value="' + data.data_arsips_id + '" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>';
                                        }




                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "No Arsip",
                                    "render": function(data, row, type, meta) {
                                        return data.nomor_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "TGL",
                                    "render": function(data, row, type, meta) {
                                        return data.tgl_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Pencipta",
                                    "render": function(data, row, type, meta) {
                                        return data.nama_pencipta_arsips;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Unit",
                                    "render": function(data, row, type, meta) {
                                        return data.nama_data_unit_penciptas;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Stok",
                                    "render": function(data, row, type, meta) {
                                        return data.stok_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Klasifikasi",
                                    "render": function(data, row, type, meta) {
                                        return data.main_code + " - " + data.arsip_nama;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Box",
                                    "render": function(data, row, type, meta) {
                                        return data.code_boxes + " - " + data.nama_boxes;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Jumlah",
                                    "render": function(data, row, type, meta) {
                                        return data.jumlah_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Status",
                                    "render": function(data, row, type, meta) {
                                        return data.level;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Penerima",
                                    "render": function(data, row, type, meta) {
                                        return data.penerima_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Halaman",
                                    "render": function(data, row, type, meta) {
                                        return data.lembar_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "Ket",
                                    "render": function(data, row, type, meta) {
                                        return data.ket_arsip;
                                    }
                                },
                                {
                                    "mData": null,
                                    "title": "File",
                                    "render": function(data, row, type, meta) {
                                        return '<a href="' + data.file_arsip + '" target="_blank" class="btn btn-success waves-effect waves-light"><i class="fas fa-download"></i></a>';
                                    }
                                },


                            ]
                        });

                        $('#store').click(function(e) {
                            // Get the selected file 
                            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                            if ($('#id_conten').val() == "") {
                                if ($('#nama_data_unit_penciptas').val() == "") {
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
                                    var file_arsip = $('#file_arsip')[0].files;
                                    fd.append('nomor_arsip', $('#nomor_arsip').val());
                                    fd.append('tgl_arsip', $('#tgl_arsip').val());
                                    fd.append('pencipta_arsips_id', $('#pencipta_arsips_id').val());
                                    fd.append('data_unit_penciptas_id', $('#data_unit_penciptas_id').val());
                                    fd.append('klasifiakasi_arsips_id', $('#klasifiakasi_arsips_id').val());
                                    fd.append('data_boxes_id', $('#data_boxes_id').val());
                                    fd.append('jumlah_arsip', $('#jumlah_arsip').val());
                                    fd.append('level', $('#level').val());
                                    fd.append('ket_arsip', $('#ket_arsip').val());
                                    fd.append('penerima_arsip', $('#penerima_arsip').val());
                                    fd.append('lembar_arsip', $('#lembar_arsip').val());
                                    fd.append('file_arsip', file_arsip[0]);
                                    fd.append('_token', CSRF_TOKEN);

                                    $.ajax({
                                        url: "{{ route('dataarsip.store') }}",
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
                                if ($('#nama_data_unit_penciptas').val() == "") {
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
                                    var file_arsip = $('#file_arsip')[0].files;
                                    fd.append('id_conten', $('#id_conten').val());
                                    fd.append('nomor_arsip', $('#nomor_arsip').val());
                                    fd.append('tgl_arsip', $('#tgl_arsip').val());
                                    fd.append('pencipta_arsips_id', $('#pencipta_arsips_id').val());
                                    fd.append('data_unit_penciptas_id', $('#data_unit_penciptas_id').val());
                                    fd.append('klasifiakasi_arsips_id', $('#klasifiakasi_arsips_id').val());
                                    fd.append('data_boxes_id', $('#data_boxes_id').val());
                                    fd.append('jumlah_arsip', $('#jumlah_arsip').val());
                                    fd.append('level', $('#level').val());
                                    fd.append('ket_arsip', $('#ket_arsip').val());
                                    fd.append('penerima_arsip', $('#penerima_arsip').val());
                                    fd.append('lembar_arsip', $('#lembar_arsip').val());
                                    fd.append('file_arsip', file_arsip[0]);
                                    fd.append('_token', CSRF_TOKEN);

                                    $.ajax({
                                        url: "{{ route('dataarsip.update') }}",
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
                                            console.log(response);
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
                                        url: "{{route('dataarsip.show','src')}}",
                                        cache: false,
                                        data: {
                                            "post_data": post_data,
                                            "_token": token
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            $("#id_conten").val(response.data.data_arsips_id).change();
                                            $("#nomor_arsip").val(response.data.nomor_arsip).change();
                                            $("#tgl_arsip").val(response.data.tgl_arsip).change();
                                            $("#pencipta_arsips_id").val(response.data.pencipta_arsips_id).change();
                                            $("#klasifiakasi_arsips_id").val(response.data.klasifiakasi_arsips_id).change();
                                            $("#data_boxes_id").val(response.data.data_boxes_id).change();
                                            $("#jumlah_arsip").val(response.data.jumlah_arsip).change();
                                            $("#level").val(response.data.level).change();
                                            $("#file_arsip").val("").change();
                                            $("#ket_arsip").val(response.data.ket_arsip).change();
                                            $("#penerima_arsip").val(response.data.penerima_arsip).change();
                                            $("#lembar_arsip").val(response.data.lembar_arsip).change();
                                            setTimeout(function() {
                                                $("#data_unit_penciptas_id").val(response.data.data_unit_penciptas_id).change();
                                                $("#MTData").modal('show');
                                                swal.close();
                                            }, 500);
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
                                        url: "{{ route('dataarsip.destroy') }}",
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