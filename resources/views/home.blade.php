@extends('home.includes.parent');
@section('content')
<style>
    * {color: #012970;}
</style>
<div class="container  card p-4">
    <div class="row "   >
        <h1>Wellcome {{ Auth::user()->name }} <i class="bi bi-person-check-fill"></i></h1>
        <hr>
        <div class="card p-2">
            <div class="text-center list-group-item">
                <h2 class="fw-bold fs-2" style="color: #012970;">Semangat 🫡</h2>
                <h1><strong><span id="clock"></span></strong></h1>
                </div>
        </div>
        <!-- tambahkan jam di sini -->
        <div class="p-2">
            <h3 class="text-center p-2 text-uppercase"><strong>{{ Auth::user()->name }} INFO <i class="bi bi-person-circle"></i></strong></h3>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true">Username : <strong>{{ Auth::user()->name }}</strong></li>
                <li class="list-group-item">Email : <strong>{{ Auth::user()->email }}</strong></li>
                <li class="list-group-item">Title : <strong>{{ Auth::user()->role }}</strong></li>
                <!-- Tambahkan div untuk menampilkan jam -->
                
            </ul>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk mengambil waktu saat ini dan memperbarui elemen HTML dengan ID 'clock'
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        document.getElementById('clock').innerText = hours + ':' + minutes + ':' + seconds;

        setTimeout(updateClock, 1000); // Memperbarui setiap 1 detik
    }

    // Memanggil fungsi updateClock saat halaman dimuat
    window.onload = updateClock;
</script>

@endsection