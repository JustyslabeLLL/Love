<!DOCTYPE html>
<html>
<head>
    <title>Запись на услугу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
        .fc-event {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Запись на услугу</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
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

            <div class="mb-3">
                <label for="booking_date">Дата записи:</label>
                <input type="text" name="booking_date" id="booking_date" class="form-control" readonly required>
            </div>

            <div class="mb-3">
                <label for="booking_time">Время записи:</label>
                <input type="text" name="booking_time" id="booking_time" class="form-control" readonly required>
            </div>

            <div class="mb-3">
                <label for="client_name">Имя клиента:</label>
                <input type="text" name="client_name" id="client_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="client_phone">Телефон клиента:</label>
                <input type="text" name="client_phone" id="client_phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Забронировать</button>
        </form>

        <h2 class="mt-5">Доступные слоты</h2>
        <div id="calendar"></div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
let calendar;

function initCalendar() {
    calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'timeGridWeek',
        slotDuration: '00:15:00',
        slotMinTime: '09:00:00',
        slotMaxTime: '21:00:00',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
        },
        events: async function(fetchInfo, successCallback) {
            try {
                const masterId = document.getElementById('master_id').value;
                const serviceId = document.getElementById('service_id').value;

                if (!masterId || !serviceId) {
                    successCallback([]);
                    return;
                }

                const response = await fetch(`/bookings/available-slots?master_id=${masterId}&service_id=${serviceId}&t=${Date.now()}`);

                if (!response.ok) {
                    throw new Error('Ошибка сервера');
                }

                const data = await response.json();
                console.log('Получены слоты:', data);
                successCallback(data);
            } catch (error) {
                console.error('Ошибка:', error);
                successCallback([]);
            }
        },
        eventClick: function(info) {
            if (info.event.extendedProps.isAvailable) {
                const start = info.event.start;
                const dateStr = start.toLocaleDateString('ru-RU');
                const timeStr = start.toLocaleTimeString('ru-RU', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });

                document.getElementById('booking_date').value = dateStr;
                document.getElementById('booking_time').value = timeStr;
            }
        }
    });

    calendar.render();
}

document.addEventListener('DOMContentLoaded', function() {
    initCalendar();

    document.getElementById('master_id').addEventListener('change', async function() {
        const masterId = this.value;
        const serviceSelect = document.getElementById('service_id');

        serviceSelect.innerHTML = '<option value="">Выберите услугу</option>';

        if (masterId) {
            try {
                const response = await fetch(`/masters/${masterId}/services?t=${Date.now()}`);
                const services = await response.json();

                services.forEach(service => {
                    const option = new Option(
                        `${service.name} (${service.duration} мин)`,
                        service.id
                    );
                    serviceSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Ошибка загрузки услуг:', error);
            }
        }

        calendar.refetchEvents();
    });

    document.getElementById('service_id').addEventListener('change', function() {
        calendar.refetchEvents();
    });
});
    </script>
</body>
</html>
