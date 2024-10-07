@extends('backpack::layout')

@section('content')
    <div>
        <canvas id="studentsChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // جلب بيانات الخط البياني
        fetch('{{ url('admin/students/chart/data') }}')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.classroom_id);
                const counts = data.map(item => item.count);

                const ctx = document.getElementById('studentsChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'line', // نوع الرسم البياني
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'عدد الطلاب',
                            data: counts,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
@endsection
