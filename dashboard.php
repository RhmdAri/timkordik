<div class="page-heading">
                <h1 class="page-title">Calendar</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Calendar</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-md-3">
                        <div id="external-events">
                            <h5 class="m-b-10">Draggable Events</h5>
                            <div class="ex-event bg-green" data-class="bg-green">My Event 1</div>
                            <div class="ex-event bg-blue" data-class="bg-blue">My Event 2</div>
                            <div class="ex-event bg-orange" data-class="bg-orange">My Event 3</div>
                            <div class="ex-event bg-red" data-class="bg-red">My Event 4</div>
                            <div class="ex-event bg-silver" data-class="bg-silver">My Event 5</div>
                            <p class="m-l-10 m-t-20">
                                <label>
                                    <input class="m-r-5" id="drop-remove" type="checkbox">remove after drop</label>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div id="calendar"></div>
                                <div class="modal fade" id="new-event-modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <form class="modal-content form-horizontal" action="javascript:;">
                                            <div class="modal-header bg-silver-100">
                                                <h4 class="modal-title">New Event</h4>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Title:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="new-event-title" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="date_1">
                                                    <label class="col-sm-2 col-form-label">Start:</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group datepicker date">
                                                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                                            <input class="form-control" id="new-event-start" type="text" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">End:</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group datepicker date">
                                                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                                            <input class="form-control" id="new-event-end" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Color:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="new-event-color">
                                                            <option value="bg-blue">Blue</option>
                                                            <option value="bg-red">Red</option>
                                                            <option value="bg-green">Green</option>
                                                            <option value="bg-orange">Orange</option>
                                                            <option value="bg-silver">Silver</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10 ml-sm-auto">
                                                        <label class="ui-checkbox ui-checkbox-info">
                                                            <input id="new-event-allDay" type="checkbox">
                                                            <span class="input-span"></span>All Day</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-info" id="addEventButton" type="submit">Add event</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="event-modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <form class="modal-content form-horizontal" action="javascript:;">
                                            <div class="modal-header bg-silver-100">
                                                <h4 class="modal-title">Edit Event</h4>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Title:</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="event-title" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="date_1">
                                                    <label class="col-sm-2 col-form-label">Start:</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group datepicker date">
                                                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                                            <input class="form-control" id="event-start" type="text" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">End:</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group datepicker date">
                                                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                                            <input class="form-control" id="event-end" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Color:</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="event-color">
                                                            <option value="bg-blue">Blue</option>
                                                            <option value="bg-red">Red</option>
                                                            <option value="bg-green">Green</option>
                                                            <option value="bg-orange">Orange</option>
                                                            <option value="bg-silver">Silver</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10 ml-sm-auto">
                                                        <label class="ui-checkbox ui-checkbox-info">
                                                            <input id="event-allDay" type="checkbox">
                                                            <span class="input-span"></span>All Day</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-info" id="editEventButton" type="submit">Save</button>
                                                <button class="btn btn-danger" id="deleteEventButton" type="button" data-dismiss="modal">Delete</button>
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>