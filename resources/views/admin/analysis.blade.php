@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <h2>Analysis Page</h2>

        <!-- الرسوم البيانية -->
        <div class="row">
            <!-- الرسم البياني للطلاب حسب الفصل -->
            <div class="col-md-6">
                <h4>Students per Classroom</h4>
                <canvas id="studentsChart"></canvas>
            </div>

            <!-- الرسم البياني للطلاب حسب العمر -->
            <div class="col-md-6">
                <h4>Students by Age</h4>
                <canvas id="studentsAgeChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- رسم بياني: عدد الطلاب حسب الفصل -->
    <script>
        const studentsPerClassroom = @json($studentsPerClassroom);

        const labels = studentsPerClassroom.map(item => `Classroom ID: ${item.classroom_id}`);
        const counts = studentsPerClassroom.map(item => item.count);

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
    </script>

    <!-- رسم بياني: عدد الطلاب حسب العمر -->
    <script>
        const studentsByAge = @json($studentsByAge);
        const ageLabels = studentsByAge.map(item => `Age: ${item.age}`);
        const ageCounts = studentsByAge.map(item => item.count);

        const ageCtx = document.getElementById('studentsAgeChart').getContext('2d');
        const studentsAgeChart = new Chart(ageCtx, {
            type: 'line',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Number of Students by Age',
                    data: ageCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
    </script>
@endsection
