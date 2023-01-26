@extends('layouts.admin')
@section('content')
<div>
    @if ($message = Session::get('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!!</strong><span> {{ $message }}</span>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!!</strong><span> {{ $message }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Meeting Room Reservations</h4>
                    <span>Here is the list of Reservations in Meeting Room</span>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="icofont icofont-simple-left "></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div id="header-content">
                <div class="d-flex mx-3 mb-3" style="justify-content:space-between !important">
                    <div class="pcoded-search" id="search" style="width: 500px !important;">
                        <span class="searchbar-toggle"></span>
                        <form method="GET" action="{{ route('reservation.index') }}">
                            @csrf
                            <div class="pcoded-search-box d-flex">
                                <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>                                                                                                               
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="in" placeholder="Enter Reservation Time" name="in"> 
                                </div>
                                <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time Out</label>
                                <div class="col-sm-3">
                                <input type="date" class="form-control" id="out" placeholder="Enter Reservation Time" name="out">
                                
                            </div>     
                            
                            <div>                                
                                <button type="submit" class="btn btn-primary">Meeting Load</button>
                            </div>
                        </form>
                    </div></div>
                    <button class="btn btn-primary ml-3" onclick="showFormAddReservation(); return false;"><i class="ti-plus"></i>Add Meeting</button>
                </div>
            </div>


            {{-- Add Data --}}
            <div class="mx-3" style="display:none;" id="formAddReservation">
                <h4 class="mb-3">Select Karyawan</h4>
                <form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama User</label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" placeholder="Input Nama" name="nama">
                            </div>

                            {{-- <select name="user_id" class="form-control" autofocus>
                            <option >--PILIH Nama Karyawan--</option>
                                @foreach($user as $c)
                                <option value="{{$c->user_id}}">{{$c->name}}
                                </option>
                                @endforeach

                            </select> --}}
                        </div>
                    </div>   

                    <div class="form-group row">
                        <label for="meeting_id" class="col-sm-3 col-form-label">Room Meeting</label>
                        
                        <div class="col-sm-8">
                            <select name="meeting_id" id="meeting_id" class="form-control">
                                <option value="" selected disabled>===== Pilih Meeting Room =====</option>
                                @foreach($meeting as $data)
                                    <option value="{{$data->meeting_id}}">{{$data->meeting_id}} | {{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                           {{-- <div class="col-sm-8">
                                @foreach($meeting as $s)
                                <input type="radio" id="service{{$s->service_id}}" name="service_id[]" value="{{$s->service_id}}">
                                <label for="service{{$s->service_id}}">{{$s->service_id}}|{{$s->name}}</label>
                                @endforeach                            
                        </div> --}}
                    </div>
                    <div class="form-group row">
                        <label for="datee" class="col-sm-3 col-form-label">Date Meeting</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="datee" placeholder="Enter Reservation Time" name="datee">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="reservation_time" placeholder="Enter Reservation Time" name="reservation_time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reservation_time_out" class="col-sm-3 col-form-label">Meeting Time Out</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="reservation_time_out" placeholder="Enter Reservation Time" name="reservation_time_out">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Ket</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket" placeholder="Enter Reservation Time" name="ket">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Ket</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket" placeholder="Enter Reservation Time" name="ket">
                        </div>
                    </div> --}}
                    <div>
                        <a type="button"  class="btn btn-primary btn-outline-primary" onclick="hideForm()">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover" id="reservationTable">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Tanggal</th>
                            <th>Meeting Time In</th>
                            <th>Meeting Time Out</th>
                            <th>Keterangan</th>
                            <th>Meeting Room</th>
                            <th>User</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @php 
                        use App\Models\reservationStatus;
                            $no = 1; 
                            @endphp
                        @foreach($reservation as $r)
                        <?php 
                        // $reservationStatus1 = reservationStatus::all();
                        ?>
                        <tr>
                            <!-- <th scope="row">{{$no++}}</th>                         -->
                            <td>{{$r->date}}</td>
                            <td>{{$r->reservation_time}}</td>
                            <td>{{$r->reservation_time_out}}</td>
                            <td>{{$r->ket}}</td>
                            <td>{{$r->meeting->name}}</td>
                            <td>{{$r->nama}}</td>
                            <td> <div id="status{{$r->status}}">                             
                                @if($r->status )
                                <div
                                style="background: rgb(74, 212, 132); color: white; padding: 7px; font-size: 12px;">
                                Done</div>
                                @else
                                <div
                                        style="background: rgb(214, 84, 84); color: white; padding: 7px; font-size: 12px;">
                                        Dipakai </div></i>
                                @endif
                            </div>
                            <div id="editStatus{{$r->reservation_id}}" style="display:none">
                                <form method="post"
                                    action="{{ route('reservation.update', $r->reservation_id) }}"
                                    style="display: flex">
                                    @csrf
                                    @method('PUT')
                                    <select style="margin-top: 5px" name="status" class="form-control">
                                        <option value="0">Dipakai</option>
                                        <option value="1">Done</option>
                                    </select>
                                    <div style="margin-top: 5px; margin-left: 10px">
                                        <button type="submit" class="btn btn-primary">Done</button>
                                        <a href="" class="btn btn-sm" onclick = "$('#editStatus{{$r->reservation_id}}').hide(); $('#status{{$r->reservation_id}}').show(); return false; ">&times;</a>
                                    </div>
                                </form>
                            </div>
                        </td>
                        
                            {{-- <td style="display: flex; justify-content: space-between">
                                <a type="button" class="btn btn-warning" href=""
                                onclick="$('#editStatus{{$r->reservation_id}}').show(); $('#status{{$r->reservation_id}}').hide(); return false; ">
                                <i class="ti-marker-alt"></i></a>
                                <a type="button" class="btn btn-warning" href="{{ route('reservation.edit', $r) }}"><i class="ti-marker-alt"></i></a>
                                {{-- <form style="display: none" id="deleteReservation{{$r->reservation_id}}" action="{{ route('reservation.destroy', $r->reservation_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}
                                {{-- <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteReservation{{$r->reservation_id}}').submit();"><i class="ti-trash"></i></button> --}}
                                {{-- <button class="btn btn-inverse" data-toggle="modal" data-target="#reservation{{$r->reservation_id}}" data-toggle="tooltip" data-original-title="see detail"><i class="
                                    ti-zoom-in"></i>Show</button>
                            </td>  --}}
                        </tr>
                        {{-- <div class="modal fade" id="reservation{{$r->reservation_id}}" tabindex="-1" role="dialog" aria-labelledby="reservation{{$r->reservation_id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div>
                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail
                                                {{$r->pegawai->name}}'s Reservation
                                            </h5>
                                            <h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
                                        </div>
                                        <a style="border-radius:5px" class="btn btn-sm btn-success" href="{{route('printReservationPDF', $r)}}" target="_blank" rel="noopener noreferrer">Print
                                            PDF</a>
                                    </div>
                                    <div class="modal-body">
                                        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Customer</h5>
                                            <div style="display: flex; justify-content: space-between">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Name :{{$r->pegawai->name}}</li>
                                                    <li class="list-group-item">E-Mail :{{$r->customer->email}}</li>
                                                    <li class="list-group-item">Phone :{{$r->customer->phone}}</li>
                                                    <li class="list-group-item">Reservation Time
                                                        :{{$r->reservation_time}}</li>                                                        
                                                </ul>
                                                <img class="float-right my-2" width="170px" height="170px" style="border-radius: 10%" src="{{asset('storage/'.$r->customer->image)}}">
                                            </div>
                                        </div>
                                        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                                            <div>
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($reservationServices as $rS)
                                                    @if ($r->reservation_code == $rS->reservation_code)
                                                    <li style="display: flex; justify-content: space-between" class="list-group-item">
                                                        Service: {{$rS->service->name}}<br>
                                                        Price: {{$rS->service->price}}
                                                        <img width="50px" height="50px" style="border-radius: 10%" src="{{asset('storage/'.$rS->service->image)}}">
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Reservation Status</h5>
                                            <div>
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($reservationStatus as $rStatus)
                                                    @if ($r->reservation_code == $rStatus->reservation_code)
                                                    <li class="list-group-item">Total: {{$rStatus->price}}</li>
                                                    @if ($rStatus->status)
                                                    <li class="list-group-item">Status: Done</li>
                                                    @else
                                                    <li class="list-group-item">Status: Waiting Customer</li>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 3000 ); 

});
    </script>
<script>
    function showFormAddReservation() {
        console.log('OK')
        var formAdd = document.getElementById('formAddReservation');
        var csTable = document.getElementById('reservationTable');
        var header = document.getElementById('header-content')
        console.log(header)
        if (formAdd.style.display === "none") {
            formAdd.style.display = "";
            csTable.style.display = "none";
            header.style.display = "none";
        } else {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display = "block";
        }
    }

    function hideForm() {
        console.log('OK')
        var formAdd = document.getElementById('formAddReservation');
        var csTable = document.getElementById('reservationTable');
        var header = document.getElementById('header-content')
        if (formAdd.style.display === "") {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display = "";
        }
    }
</script>
@endsection