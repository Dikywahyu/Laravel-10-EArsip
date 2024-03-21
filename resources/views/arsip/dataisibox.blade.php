<!DOCTYPE html>
<html lang="en">

@include('parsial/head')

<body class="skin-blue fixed-layout">
    @include('parsial/loader')
    <div id="main-wrapper">



        <div class="container-fluid">


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


                    var table = $('#datatable-main').DataTable({
                        responsive: true,
                        dom: 'Bfrtip',
                        lengthChange: false,
                        ajax: {
                            method: "post",
                            url: "{{route('dataarsip.show', ['user' => 'box'])}}",
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
                            },
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


                        ]
                    });

                    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-tambah').addClass('btn btn-primary me-1 m-1');


                });
            </script>


            @include('parsial/rightmenu')

        </div>


        @include('parsial/footer')

    </div>

    @include('parsial/js')
</body>

</html>