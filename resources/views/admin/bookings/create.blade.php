<!DOCTYPE html>
<html>
<head>
    <title>Запись на услугу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Запись на услугу</h1>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
    <!-- bookings/create.blade.php -->
            <div class="mb-3">
                <label for="master_id">Мастер:</label>
                <select name="master_id" id="master_id" class="form-control" required>
                    <option value="">Выберите мастера</option>
                    @foreach ($masters as $master)
                        <option value="{{ $master->id }}">{{ $master->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="service_id">Услуга:</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="">Выберите услугу</option>
                </select>
            </div>
    </div>
</body>
</html>
