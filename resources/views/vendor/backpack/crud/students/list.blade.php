{{-- resources/views/vendor/backpack/crud/students/list.blade.php --}}
@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <h3 style="text-align: center; font-family: 'Arial', sans-serif; color: #333;">Students Chart</h3>
        <canvas id="studentsChart" width="200" height="200"></canvas>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // جلب البيانات من API (الذي يقدمه Laravel عبر `getChartData`)
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
                            backgroundColor: 'rgba(75, 192, 192, 0.4)', // لون خلفية
                            borderColor: 'rgba(75, 192, 192, 1)', // لون الحدود
                            borderWidth: 2,
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.6)', // لون عند التحويم
                            hoverBorderColor: 'rgba(75, 192, 192, 1)', // لون الحدود عند التحويم
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Students',
                                    font: {
                                        size: 16,
                                        weight: 'bold',
                                        family: 'Arial, sans-serif',
                                    },
                                    color: '#333',
                                },
                                grid: {
                                    color: '#e0e0e0',
                                    lineWidth: 1,
                                },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Classroom IDs',
                                    font: {
                                        size: 16,
                                        weight: 'bold',
                                        family: 'Arial, sans-serif',
                                    },
                                    color: '#333',
                                },
                                grid: {
                                    display: false,
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    font: {
                                        size: 14,
                                        family: 'Arial, sans-serif',
                                    },
                                    color: '#333',
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });
            });
    </script>
@endsection
