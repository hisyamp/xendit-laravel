<!DOCTYPE HTML>
<html>
	<head>
		<title>Laravel Xendit</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<h1 style="color: black">Laravel Xendit</h1>
				<p style="color: black">Demo sederhana integrasi laravel xendit, Just sharing brader</p>
			</header>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="#">
				<input type="text" id="nama" placeholder="Masukkan Nama Anda" />
				<input type="submit" value="Mulai" id="start" onclick="modal1()"/>
			</form>
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="text-header1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="text-header1" style="color: black"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="before">
                        <div class="input-group mb-3">
                            <select class="custom-select" id="paket">
                                <option selected value="">Pilih Paket</option>
                                <option value="50000">SUPER</option>
                                <option value="100000">SUPERDUPER</option>
                                <!-- <option value="3"></option> -->
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="carabayar">Option</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="mode">
                                <option selected value="">Pilih Metode Pembayaran</option>
                                <option value="1">VA</option>
                                <option value="2">Transfer</option>
                                <!-- <option value="3"></option> -->
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="carabayar">Option</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="bank">
                                <option selected value="">Pilih Bank</option>
                                <option value="BNI">Bank Negara Indonesia</option>
                                <option value="MANDIRI">Bank Mandiri</option>
                                <option value="PERMATA">Bank Permata</option>
                                <option value="SAHABAT_SAMPOERNA">Bank Sahabat Sampoerna</option>
                                <option value="BRI">Bank Rakyat Indonesia</option>
                                <option value="BSI">Bank Syariah Indonesia</option>
                                <option value="BJB">Bank Jabar Banten</option>
                                <option value="DBS">DBS</option>
                                <!-- <option value="3"></option> -->
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="carabayar">Option</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="after">
                <div class="col-12">
                    <p class="lead">INVOICE</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td id="total-invoice"></td>
                                </tr>
                                <tr>
                                    <th>Nama:</th>
                                    <td id="nama-invoice"></td>
                                </tr>
                                <tr>
                                    <th>Nomor VA:</th>
                                    <td id="akun-invoice"></td>
                                </tr>
                                <tr>
                                    <th>Berakhir pada :</th>
                                    <td id="expired-invoice"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary before" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-secondary after" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary before" id="tbl-bayar" onclick="bayar()">Bayar</button>
                </div>
                </div>
            </div>
            </div>
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Untitled.</li><li>Credits: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
			</footer>
            
		<!-- Scripts -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script src="assets/js/main.js"></script>
            <script>
                function reqbayar(){
                    $.ajax({
                        url: "{{url('/invoice')}}" ,
                        type: "post",
                        data: {
                            "paket": $("#paket").val(),
                            "nama" : a,
                            "mode": $("#mode").val(),
                            "bank": $("#bank").val(),
                            "_token": "{{ csrf_token() }}",

                            },
                        success: function(data) {
                            if(data.status == "success"){
                                $(".before").hide()
                                $(".after").show()
                                $("#before").hide()
                                $("#after").show()
                                $("#total-invoice").html(data.data.expected_amount)
                                $("#nama-invoice").html(data.data.name)
                                $("#akun-invoice").html(data.data.account_number)
                                $("#expired-invoice").html(data.data.expiration_date)
                            }else{
                                console.log('gagal')
                                return false
                            }
                        },
                        error: function(data) { 
                            console.log(data)
                        }
                    });
                }
                function bayar(){
                    // console.log($("#paket").val())
                    // console.log($("#mode").val())
                    // console.log($("#bank").val())
                    if($("#paket").val() != "" && $("#mode").val() != "" && $("#bank").val() != ""){
                        swal({
                            title: "Konfirmasi",
                            text: "Apakah yakin ingin melakukan pembayaran?",
                            icon: "warning",
                            buttons: true,
                            // dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                reqbayar()
                            } else {
                                // swal("Your imaginary file is safe!");
                                return false;
                            }
                        });
                    }
                } 
                var a = "";
                function modal1(){
                    $("#after").hide()
                    $(".after").hide()
                    a = $("#nama").val()
                    if(a != ""){
                        $("#text-header1").html("Halooo " + a);
                        $("#modal1").modal("show")
                    }
                }
                $(document).ready(function() {
                    $.ajaxSetup({   
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                });
            
            </script>
	</body>
</html>