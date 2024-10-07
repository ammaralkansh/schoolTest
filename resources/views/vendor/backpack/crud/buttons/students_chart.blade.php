<div class="container">
    <h3>Students Chart</h3>
    
    <a href="{{ route('students.chart') }}" class="btn btn-primary">View Students Chart</a>


    <canvas id="studentsChart" width="600" height="300"></canvas>
</div>

@section('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // جلب البيانات من API الذي يقدمه Laravel عبر `getChartData`
        fetch("{{ url('admin/students/chart-data') }}")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => `Classroom ID: ${item.classroom_id}`);
                const counts = data.map(item => item.count);

                const ctx = document.getElementById('studentsChart').getContext('2d');
                const studentsChart = new Chart(ctx, {
                    type: 'bar', // أو 'line' أو نوع آخر من الرسم البياني
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
