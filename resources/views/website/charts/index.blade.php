@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/dailog.css') }}" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('main')
<section>
    <div style="display: flex;justify-content: center;align-items: center;margin-top: 50px;margin-bottom: 50px;">
        <img src="{{ asset('web/img/home-l/image.svg') }}" alt="" width="85%">
    </div>
</section>

<section class="main">
    <div class="container">
        <canvas id="blogChart" width="600" height="200"></canvas>
    </div>
</section>

@endsection

@section('script')
<script>
    const labels = @json($labels); // Label untuk hari-hari Senin sampai Jumat
    const publishedData = @json($publishedData); // Data jumlah postingan yang dipublikasikan
    const draftData = @json($draftData); // Data jumlah postingan yang masih draft

    const ctx = document.getElementById('blogChart').getContext('2d');
    const blogChart = new Chart(ctx, {
        type: 'line', // Tipe grafik garis
        data: {
            labels: labels, // Label hari
            datasets: [
                {
                    label: 'Published Posts',
                    data: publishedData, // Data jumlah postingan yang dipublikasikan
                    borderColor: '#697565',
                    backgroundColor: '#697565',
                    tension: 0.4, // Membuat garis grafik lebih halus
                },
                {
                    label: 'Draft Posts',
                    data: draftData, // Data jumlah postingan yang masih draft
                    borderColor: '#ECDFCC',
                    backgroundColor: '#ECDFCC',
                    tension: 0.4, // Membuat garis grafik lebih halus
                }
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true, // Mulai dari angka 0
                },
            },
        },
    });
</script>

@endsection
