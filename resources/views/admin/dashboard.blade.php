@extends('admin.layouts.default')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="mb-4 text-center">
            <h2>Laporan Sekolah</h2>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2 rounded-circle">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-bank2 opacity-10"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Jumlah sekolah</p>
                        <h4 class="mb-0">{{ $sekolahs->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2 rounded-circle">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="bi bi-person opacity-10"></i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Jumlah siswa</p>
                        <h4 class="mb-0">{{ $siswas->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </>
</div>

<!-- Tambahkan div untuk grafik berdasarkan tanggal kadaluarsa -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan Sekolah Berdasarkan Tanggal Kadaluarsa</h5>
            </div>
            <div class="card-body">
                <canvas id="sekolahChartByDate"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan div untuk grafik berdasarkan tipe -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan Sekolah Berdasarkan Tipe</h5>
            </div>
            <div class="card-body">
                <canvas id="sekolahChartByType"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan div untuk grafik berdasarkan provinsi -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan Sekolah Berdasarkan Provinsi</h5>
            </div>
            <div class="card-body">
                <canvas id="sekolahChartByProvince"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ctxByDate = document.getElementById('sekolahChartByDate').getContext('2d');
    var ctxByType = document.getElementById('sekolahChartByType').getContext('2d');
    var ctxByProvince = document.getElementById('sekolahChartByProvince').getContext('2d');

    // Mendapatkan data dari PHP dan mengonversinya ke format JavaScript
    var sekolahDataByDate = @json($sekolahDataByDate);
    var sekolahDataByType = @json($sekolahDataByType);
    var sekolahDataByProvince = @json($sekolahDataByProvince);
    var provinsiData = @json($provinsiData);

    console.log("Data by Date:", sekolahDataByDate);
    console.log("Data by Type:", sekolahDataByType);
    console.log("Data by Province:", sekolahDataByProvince);
    console.log("Provinces:", provinsiData);

    // Data untuk grafik berdasarkan tanggal kadaluarsa
    var labelsByDate = sekolahDataByDate.map(function (item) {
        return item.date;
    });
    var dataByDate = sekolahDataByDate.map(function (item) {
        return item.count;
    });

    var dataForDateChart = {
        labels: labelsByDate,
        datasets: [{
            label: 'Jumlah Sekolah Berdasarkan Tanggal Kadaluarsa',
            data: dataByDate,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    var sekolahChartByDate = new Chart(ctxByDate, {
        type: 'bar',
        data: dataForDateChart,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal Kadaluarsa'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Sekolah'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik berdasarkan tipe
    var labelsByType = sekolahDataByType.map(function (item) {
        return item.type;
    });
    var dataByType = sekolahDataByType.map(function (item) {
        return item.count;
    });

    var dataForTypeChart = {
        labels: labelsByType,
        datasets: [{
            label: 'Jumlah Sekolah Berdasarkan Tipe',
            data: dataByType,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    };

    var sekolahChartByType = new Chart(ctxByType, {
        type: 'bar',
        data: dataForTypeChart,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tipe Sekolah'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Sekolah'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik berdasarkan provinsi
    var provinsiMap = new Map();
    provinsiData.forEach(function (provinsi) {
        provinsiMap.set(provinsi.id, provinsi.nama);
    });

    console.log("Provinsi Map:", Array.from(provinsiMap.entries()));

    // var labelsByProvince = sekolahDataByProvince.map(function (item) {
    //     var provinsiName = provinsiMap.get(item.provinsi);
    //     console.log("Provinsi Name for ID", item.provinsi, ":", provinsiName);
    //     return provinsiName || 'Unknown';
    // });
    var labelsByProvince = sekolahDataByProvince.map(function (item) {
    var provinsiName = provinsiData.find(p => p.id == item.provinsi)?.nama;
    console.log("Provinsi Name for ID", item.provinsi, ":", provinsiName);
    return provinsiName || 'Unknown';
    });
    var dataByProvince = sekolahDataByProvince.map(function (item) {
        return item.count;
    });

    console.log("Labels by Province:", labelsByProvince);
    console.log("Data by Province:", dataByProvince);

    var dataForProvinceChart = {
        labels: labelsByProvince,
        datasets: [{
            label: 'Jumlah Sekolah Berdasarkan Provinsi',
            data: dataByProvince,
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    };

    var sekolahChartByProvince = new Chart(ctxByProvince, {
        type: 'bar',
        data: dataForProvinceChart,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Provinsi'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Sekolah'
                    },
                    beginAtZero: true
                }
            }
        }
    });
});

</script>

@endsection
