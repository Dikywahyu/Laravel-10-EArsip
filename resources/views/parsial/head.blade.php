<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{ $description }}">
  <meta name="author" content="Diky Wahyu">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ url($img) }}">
  <title>{{ $tittle }} - {{ $institusi }}</title>
  <link href="{{ url('thme-admin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet"
    type="text/css" />
  <!--alerts CSS -->
  <link href="{{ url('thme-admin/assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
  <!-- page css -->
  <link href="{{ url('thme-admin/university/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{ url('thme-admin/university/dist/css/style.min.css') }}" rel="stylesheet">
  <!-- Bootstrap responsive table CSS -->
  <link rel="stylesheet" type="text/css"
    href="{{ url('thme-admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
  <link rel="stylesheet" type="text/css"
    href="{{ url('thme-admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}" />
  {{-- googleapis ajax --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  
</head>