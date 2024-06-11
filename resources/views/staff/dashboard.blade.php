@extends('layouts.staff')
@section('content')


<div id="breakSection">
    <div class="rightBar p-4">
        <div class="row report-section shadow-sm">
            <div class="report-box text-center">

                <button id="takeBreak" class="amount fs-3 btn btn-danger">
                    <span class="iconify" data-icon="mdi:stop-circle-outline" style="font-size: 24px; vertical-align: middle;"></span>Start Break
                </button>
                
            </div>
        </div>
    </div>

    <div class="rightBar p-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <a href="{{route('assigned.tasks.staff')}}">
                            <h5 class="card-title mb-0">Today's Assigned Tasks</h5>
                        </a>
                    </div>
                    <div class="card-body">
                        @if($assignedTasks->isEmpty())
                            <p class="card-text">No tasks assigned for today.</p>
                        @else
                        <a href="{{route('assigned.tasks.staff')}}" style="text-decoration: none; color:black">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="assignedTasksTable">
                                    <thead>
                                        <tr>
                                            <th>Job ID</th>
                                            <th>Client Details</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignedTasks as $task)
                                            <tr>
                                                <td>{{ $task->orderid }}</td>
                                                <td>{{ $task->name }} <br> {{ $task->phone }} <br>
                                                    {{ $task->email }}
                                                </td>
                                                <td>
                                                    {{$task->address_first_line}} {{$task->address_second_line}} {{$task->address_third_line}} {{$task->town}} {{$task->post_code}} 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Today's Completed Tasks</h5>
                    </div>
                    <div class="card-body">
                        @if($completedTasks->isEmpty())
                            <p class="card-text">No tasks completed today.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered" id="completedTasksTable">
                                    <thead>
                                        <tr>
                                            <th>Job ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($completedTasks as $task)
                                            <tr>
                                                <td>{{ $task->orderid }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td>{{ $task->email }}</td>
                                                <td>{{ $task->phone }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Today's Work Time</h5>
                    </div>
                    <div class="card-body p-2">
                        <p class="card-text fs-2 m-0"><span id="workDuration">{{ gmdate('H:i:s', $workDurationSum) }}</span></p>
                    </div>
                </div>
            </div> -->
        
        </div>
    </div>
</div>

<div id="breakOutSection" style="display: none;">
    <div class="rightBar p-4">
            <div class="row report-section shadow-sm">
                <div class="report-box text-center">

                    <button id="stopBreak" class="amount fs-3 btn btn-primary">
                        <input type="hidden" id="workTimeId" value="">
                        <span class="iconify" data-icon="mdi:play-circle-outline" style="font-size: 24px; vertical-align: middle;"></span>BreakOut
                    </button>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes floatAnimation {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0);
        }
    }

    #workDuration {
        display: inline-block;
        animation: floatAnimation 3s infinite;
    }

</style>

@endsection

@section('script')

<script>
    $(document).ready(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });  
    });
</script>

<!-- Data table -->
 <script>
    $(document).ready(function() {
        $('#assignedTasksTable').DataTable( {
            order: [],
            responsive: true
        });

        $('#completedTasksTable').DataTable( {
            order: [],
            responsive: true
        });
    });
</script>

<!-- Break start and stop -->
<script>
    $(document).ready(function() {
        function setupUIFromLocalStorage() {
            var workTimeId = localStorage.getItem('workTimeId');
            if (workTimeId) {
                $('#breakSection').hide();
                $('#breakOutSection').show();
                $('#workTimeId').val(workTimeId);
            } else {
                $('#breakSection').show();
                $('#breakOutSection').hide();
            }
        }

        function checkBreakStatus() {
            $.ajax({
                url: '{{ route("checkBreak") }}',
                method: 'GET',
                success: function(response) {
                    // console.log(response);
                    if (response.in_break) {
                        localStorage.setItem('workTimeId', response.workTimeId);
                    } else {
                        localStorage.removeItem('workTimeId');
                    }
                    setupUIFromLocalStorage();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }

        setupUIFromLocalStorage();
        checkBreakStatus();

        $('#takeBreak').click(function() {
            $.ajax({
                url: '{{ route("worktime.startBreak") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response);
                    localStorage.setItem('workTimeId', response.workTimeId);
                    setupUIFromLocalStorage();
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        button: "OK",
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    swal({
                        title: "Oops!",
                        text: "You are already on a break.",
                        icon: "error",
                        button: "OK",
                    }).then(function() {
                        window.location.reload();
                    });
                }
            });
        });

        $('#stopBreak').click(function() {
            var workTimeId = $('#workTimeId').val();
            $.ajax({
                url: '{{ route("worktime.stopBreak") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    work_time_id: workTimeId
                },
                success: function(response) {
                    // console.log(response);
                    localStorage.removeItem('workTimeId');
                    $('#workTimeId').val('');
                    setupUIFromLocalStorage();
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        button: "OK",
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    swal({
                        title: "Oops!",
                        text: "You have already stopped your break",
                        icon: "error",
                        button: "OK",
                    }).then(function() {
                        window.location.reload();
                    });
                }
            });
        });

    });
</script>

@endsection