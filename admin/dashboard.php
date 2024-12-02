<div class="page-heading">
    <h1 class="page-title">Kalender Kegiatan </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-3">
            <div id="external-events">
                <h5 class="m-b-10">Event Kegiatan</h5>
                <div class="ex-event bg-green" data-class="bg-green">Masukan Keterangan</div>
                <div class="ex-event bg-blue" data-class="bg-blue">Masukan Keterangan</div>
                <div class="ex-event bg-orange" data-class="bg-orange">Masukan Keterangan</div>
                <div class="ex-event bg-red" data-class="bg-red">Masukan Keterangan</div>
                <div class="ex-event bg-silver" data-class="bg-silver">Masukan Keterangan</div>
                <p class="m-l-10 m-t-20">
                    <label>
                        <input class="m-r-5" id="drop-remove" type="checkbox">hapus setelah digeser</label>
                </p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="ibox">
                <div class="ibox-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editEventModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="eventTitle" class="form-control" placeholder="Masukkan judul event">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEventBtn">Simpan Event</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var savedEvents = JSON.parse(localStorage.getItem('calendarEvents')) || [];
        var draggedEventTitle = "";
        var draggedEventClass = "";

        $('#calendar').fullCalendar({
            defaultDate: moment().format('YYYY-MM-DD'),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: savedEvents,
            droppable: true,
            drop: function(info) {
                $('#editEventModal').modal('show');
                $('#saveEventBtn').off('click').on('click', function() {
                    var eventTitle = $('#eventTitle').val();
                    if (eventTitle) {
                        var newEvent = {
                            title: eventTitle,
                            start: info.date.format(),
                            className: draggedEventClass
                        };
                        $('#calendar').fullCalendar('renderEvent', newEvent, true);
                        saveEventsToLocalStorage();
                        $('#editEventModal').modal('hide');
                    } else {
                        alert("Judul event tidak boleh kosong!");
                    }
                });
            },
            editable: true,
            droppable: true,
            dropRemove: true,
            eventClick: function(event, jsEvent, view) {
                $('#calendar').fullCalendar('removeEvents', event._id);
                saveEventsToLocalStorage();
            },
            eventDrop: function(event, delta, revertFunc) {
                saveEventsToLocalStorage();
            },
            eventResize: function(event, delta, revertFunc) {
                saveEventsToLocalStorage();
            }
        });

        $('#external-events .ex-event').each(function() {
            var eventClass = $(this).data('class');
            var eventTitle = $(this).text();

            $(this).on('click', function() {
                draggedEventTitle = eventTitle;
                draggedEventClass = eventClass;

                $('#editEventModal').modal('show');
                $('#saveEventBtn').off('click').on('click', function() {
                    var eventTitle = $('#eventTitle').val();
                    if (eventTitle) {
                        var newEvent = {
                            title: eventTitle,
                            start: moment().format('YYYY-MM-DD'),
                            className: eventClass
                        };
                        $('#calendar').fullCalendar('renderEvent', newEvent, true);
                        saveEventsToLocalStorage();
                        $('#editEventModal').modal('hide');
                    } else {
                        alert("Judul event tidak boleh kosong!");
                    }
                });
            });
        });

        function saveEventsToLocalStorage() {
            var events = $('#calendar').fullCalendar('clientEvents');
            var eventData = events.map(function(event) {
                return {
                    title: event.title,
                    start: event.start.format(),
                    end: event.end ? event.end.format() : null,
                    className: event.className
                };
            });
            localStorage.setItem('calendarEvents', JSON.stringify(eventData));
        }
    });
</script>