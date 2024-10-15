<form method="GET" action="{{ url()->current() }}" class="form-inline mb-3">
    <input type="text" name="specialization" placeholder="التخصص" class="form-control mr-2" value="{{ request('specialization') }}">
    <select name="day" class="form-control mr-2">
        <option value="">اختر اليوم</option>
        <option value="Sunday" {{ request('day') == 'Sunday' ? 'selected' : '' }}>الأحد</option>
        <option value="Monday" {{ request('day') == 'Monday' ? 'selected' : '' }}>الإثنين</option>
        <option value="Tuesday" {{ request('day') == 'Tuesday' ? 'selected' : '' }}>الثلاثاء</option>
        <option value="Wednesday" {{ request('day') == 'Wednesday' ? 'selected' : '' }}>الأربعاء</option>
        <option value="Thursday" {{ request('day') == 'Thursday' ? 'selected' : '' }}>الخميس</option>
        <option value="Friday" {{ request('day') == 'Friday' ? 'selected' : '' }}>الجمعة</option>
        <option value="Saturday" {{ request('day') == 'Saturday' ? 'selected' : '' }}>السبت</option>
    </select>
    <input type="number" name="rate_min" placeholder="الراتب الأدنى" class="form-control mr-2" step="0.01" value="{{ request('rate_min') }}">
    <input type="number" name="rate_max" placeholder="الراتب الأعلى" class="form-control mr-2" step="0.01" value="{{ request('rate_max') }}">
    <select name="subject_id" class="form-control mr-2">
        <option value="">اختر المادة الدراسية</option>
        @foreach(\App\Models\Subject::all() as $subject)
            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">بحث</button>
</form>
