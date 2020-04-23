<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Cek COVID - Pantau Penyebaran Virus Covid-19</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid bg-primary text-white">
        <div class="container text-center">
            <h1 class="display-4">Cek COVID-19</h1>
            <p class="lead">
                <h2>
                    Pantau Penyebaran Virus COVID-19
                        <br>
                    Secara REALTIME
                </h2>
            </p>
        </div>
        <div>
            <marquee>Mari bersama kita berantas Virus Covid-19 Dari Bumi Tercinta - KKN Kelompok XX Universitas Syiah Kuala</marquee>
        </div>
    </div>

    <style>
        .box {
            padding: 30px 40px;
            border-radius: 5px;
        }
    </style>

    <div class="container">
        <div class="card-header text-center">
            <b>Data Penyebaran Virus Corona Di Dunia</b>
        </div>
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="bg-danger box text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/sad.svg" alt="" style="width: 120px;">
                        </div>
                        <div class="col-md-6 mt-2">
                            <h5>Positif</h5>
                            <h2 id="data-kasus"></h2>
                            <h5>Orang</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <div class="bg-info box text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/cry.svg" alt="" style="width: 120px;">
                        </div>
                        <div class="col-md-6 mt-2">
                            <h5>Meninggal</h5>
                            <h2 id="data-meninggal"></h2>
                            <h5>Orang</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <div class="bg-success box text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/happy.svg" alt="" style="width: 120px;">
                        </div>
                        <div class="col-md-6 mt-2">
                            <h5>Sembuh</h5>
                            <h2 id="data-sembuh"></h2>
                            <h5>Orang</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="bg-primary box text-white">
                    <div class="row">
                        <div class="col-md-3 ml-5 mt-1">
                            <img src="img/indonesia.svg" alt="" style="width: 120px;">
                        </div>
                        <div class="col-md-6">
                            <h2>Indonesia</h2>
                            <h5 id="data-id">Positif    : 123 Orang <br> Meninggal    : 123 Orang <br> Sembuh    : 123 Orang</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <b>Data Penyebaran Virus Corona Di Indonesia Berdasarkan Provinsi</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered mt-1">
                    <thead>
                        <th>No.</th>
                        <th>Provinsi</th>
                        <th>Positif</th>
                        <th>Sembuh</th>
                        <th>Meninggal</th>
                    </thead>
                    <tbody id="table-data">

                    </tbody>
                </table>
            </div>
        </div>  

        

    </div>

    

    <footer class="bg-primary text-white text-center mt-3 bt-2 pb-2">
        Dibuat Oleh Kelompok XX KKN Universitas Syiah Kuala
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
        semuaData();
        dataNegara();
        dataProvinsi();

        setInterval(function(){
            semuaData();
            dataNegara();
            dataProvinsi();
        }, 2000);

        function semuaData(){
            $.ajax({
                url : 'https://coronavirus-19-api.herokuapp.com/all',
                success : function(data) {
                    try{
                        var json = data;
                        var kasus = data.cases;
                        var meninggal = data.deaths;
                        var sembuh = data.recovered;

                        $('#data-kasus').html(kasus);
                        $('#data-meninggal').html(meninggal);
                        $('#data-sembuh').html(sembuh);

                    }catch{
                        alert('Error');
                    }
                }
            });
        }

        function dataProvinsi(){
            $.ajax({
                url : 'curl.php',
                type : 'GET',
                success : function(data) {
                    try{
                        
                        $('#table-data').html(data);

                    }catch{
                        alert('Error');
                    }
                }
            });
        }

        function dataNegara() {
            $.ajax({
                url : 'https://coronavirus-19-api.herokuapp.com/countries',
                success : function(data) {
                    try{
                        var json = data;
                        var html = [];

                        if(json.length > 0){
                            var i;
                            for(i = 0; i < json.length; i++){
                                var dataNegara = json[i];
                                var namaNegara = dataNegara.country;

                                if(namaNegara === 'Indonesia'){
                                    var kasus = dataNegara.cases;
                                    var meninggal = dataNegara.deaths;
                                    var sembuh = dataNegara.recovered;

                                    $('#data-id').html(
                                        'Positif:  ' +kasus+ ' Orang <br> Meninggal : ' +meninggal+ ' Orang <br> Sembuh : ' +sembuh+ ' Orang'
                                    );
                                }
                            }
                        }
                    }catch{
                        alert('Error');
                    }
                }
            });
        }
    });
</script>