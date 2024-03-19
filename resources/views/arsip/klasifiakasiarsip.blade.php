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
                                    <div class="form-group col-6">
                                        <label class="form-label">Main Code</label>
                                        <input type="text" class="form-control" id="main_code">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Arsip Nama</label>
                                        <input type="text" class="form-control" id="arsip_nama">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Aktiv Periode</label>
                                        <input type="text" class="form-control" id="aktiv_periode">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Inaktiv Periode</label>
                                        <input type="text" class="form-control" id="inaktiv_periode">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">First Code</label>
                                        <input type="text" class="form-control" id="first_code">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Second Code</label>
                                        <input type="text" class="form-control" id="second_code">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Third Code</label>
                                        <input type="text" class="form-control" id="third_code">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Fourth Code</label>
                                        <input type="text" class="form-control" id="fourth_code">
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Afeter Periode</label>
                                        <select class="select2 form-control form-select" id="afeter_periode"
                                            style="width: 100%; height: 36px">
                                            <option value="">Pilih</option>
                                            <option value="Musnah">Musnah</option>
                                            <option value="Permanen">Permanen</option>
                                            <option value="Masuk Berkas Perorangan">Masuk Berkas Perorangan</option>
                                            <option value="Musnah Kecuali Laporan Akhir">Musnah Kecuali Laporan Akhir
                                            </option>
                                            <option value="Musnah Kecuali Laporan Fisiknya">Musnah Kecuali Laporan
                                                Fisiknya</option>
                                            <option value="Dinilai Kembali">Dinilai Kembali</option>
                                            <option value="Masih berstatus Mahasiswa">Masih berstatus Mahasiswa</option>
                                            <option value="Selama menjadi Mahasiswa">Selama menjadi Mahasiswa</option>
                                        </select>
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

                <div id="MIData" class="modal bs-example-modal-sm" role="dialog" aria-labelledby="MIData" aria-hidden="true"
                    style="display: none;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal mt-4 row"    id="formidata">
                                     
                                    <div class="form-group col-12">
                                        <label class="form-label">File Klasifiakasi</label>
                                        <input type="file" class="form-control" id="file_klas">
                                    </div>
                                     
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light text-white" id="storei">Import</button>
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
                            url: "{{route('klasifiakasiarsip.show', ['user' => 'view'])}}",
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
                            }, {
                                className: 'buttons-tambah',
                                text: 'Impost Data',
                                action: function(e, dt, node, config) {  
                                    document.getElementById("formidata").reset();
                                    $("#MIData").modal('show'); 
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
                                    return '<button   title="Edit Data"  id="EditData" value="' + data.klasifiakasi_arsips_id + '" class="btn btn-primary waves-effect waves-light"><i class="fas fa-edit "></i></button> ' +
                                        ' <button title="Hapus Data"  id="Destroy" value="' + data.klasifiakasi_arsips_id + '" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></button>';

                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Main Code",
                                "render": function(data, row, type, meta) {
                                    return data.main_code;
                                }
                            }, 
                             
                            {
                                "mData": null,
                                "title": "Arsip Name",
                                "render": function(data, row, type, meta) {
                                    return data.arsip_nama;
                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Aktif Periode",
                                "render": function(data, row, type, meta) {
                                    return data.aktiv_periode;
                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Inaktif Periode",
                                "render": function(data, row, type, meta) {
                                    return data.inaktiv_periode;
                                }
                            }, 
                            {
                                "mData": null,
                                "title": "Afeter Periode",
                                "render": function(data, row, type, meta) {
                                    return data.afeter_periode;
                                }
                            }, 
                        ]
                    });

                    $('#store').click(function(e) {
                        // Get the selected file 
                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                        if ($('#id_conten').val() == "") {
                            if (
                            $('#main_code').val() == "" ||  
                            $('#arsip_nama').val() == ""  
                            ) { 
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
                            fd.append('main_code', $('#main_code').val());   
                            fd.append('arsip_nama', $('#arsip_nama').val());  
                            fd.append('aktiv_periode', $('#aktiv_periode').val());  
                            fd.append('inaktiv_periode', $('#inaktiv_periode').val());  
                            fd.append('afeter_periode', $('#afeter_periode').val());  
                            fd.append('first_code', $('#first_code').val());  
                            fd.append('second_code', $('#second_code').val());  
                            fd.append('third_code', $('#third_code').val());  
                            fd.append('fourth_code', $('#fourth_code').val());  
                            fd.append('_token', CSRF_TOKEN);

                            $.ajax({
                                url: "{{ route('klasifiakasiarsip.store') }}",
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
                            $('#main_code').val() == "" ||  
                            $('#arsip_nama').val() == ""   
                            ) { 
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
                            fd.append('main_code', $('#main_code').val());  
                            fd.append('arsip_nama', $('#arsip_nama').val());  
                            fd.append('aktiv_periode', $('#aktiv_periode').val());  
                            fd.append('inaktiv_periode', $('#inaktiv_periode').val());  
                            fd.append('afeter_periode', $('#afeter_periode').val());  
                            fd.append('first_code', $('#first_code').val());  
                            fd.append('second_code', $('#second_code').val());  
                            fd.append('third_code', $('#third_code').val());  
                            fd.append('fourth_code', $('#fourth_code').val());  
                            fd.append('_token', CSRF_TOKEN);

                            $.ajax({
                                url: "{{ route('klasifiakasiarsip.update') }}",
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

                    $('#storei').click(function(e) {
                        // Get the selected file 
                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                         
                        var fdi = new FormData();
                            fdi.append('file_klas', $('#file_klas')[0].files[0]);
                            fdi.append('_token', CSRF_TOKEN);

                        $.ajax({
                            url: "{{ route('klasifiakasiarsip.import') }}",
                            method: 'post',
                            data: fdi,
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
                                                $("#MIData").modal('hide');
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
                                        title: response.data,
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
                                    url: "{{route('klasifiakasiarsip.show','src')}}",
                                    cache: false,
                                    data: {
                                        "post_data": post_data,
                                        "_token": token
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        $("#MTData").modal('show');
                                        $("#id_conten").val(response.data.klasifiakasi_arsips_id).change(); 
                                        $("#main_code").val(response.data.main_code).change();  
                                        $("#arsip_nama").val(response.data.arsip_nama).change(); 
                                        $("#aktiv_periode").val(response.data.aktiv_periode).change(); 
                                        $("#inaktiv_periode").val(response.data.inaktiv_periode).change(); 
                                        $("#afeter_periode").val(response.data.afeter_periode).change(); 
                                        $("#first_code").val(response.data.first_code).change(); 
                                        $("#second_code").val(response.data.second_code).change(); 
                                        $("#third_code").val(response.data.third_code).change(); 
                                        $("#fourth_code").val(response.data.fourth_code).change(); 
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
                                    url: "{{ route('klasifiakasiarsip.destroy') }}",
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