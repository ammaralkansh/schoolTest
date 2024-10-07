{{-- resources/views/vendor/backpack/crud/students_chart.blade.php --}}
@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <h3>Students Chart</h3>
        <div class="row">
            <div class="col-md-12">
                <canvas id="studentsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch("{{ url('admin/students/chart-data') }}")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => `Classroom ID: ${item.classroom_id}`);
                const counts = data.map(item => item.count);

                const ctx = document.getElementById('studentsChart').getContext('2d');
                const studentsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Students per Classroom',
                            data: counts,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    </script>
@endsection
