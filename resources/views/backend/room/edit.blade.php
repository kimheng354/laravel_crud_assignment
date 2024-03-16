@extends('backend.layouts.master')
@section('title', 'UpdateRoom')
@section('room', 'show')
@section('Content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">UpdateRoom</h1>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{url('room/update')}}" method="POST" autocomplete="off" enctype="multipart/form-data" >
            <input type="hidden" name="room_id" id="" value="{{$room->room_id}}">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Overflow Hidden -->
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <a href="{{url('room')}}" class="m-0 font-weight-bold text-primary">Back To Room</a>
                        </div>
                        <div class="card-body">



                            <div class="form-group row">
                                <label for="room_name" class="col-sm-2 col-form-label">RoomName <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_name" id="room_name" value="{{$room->room_name}}" autofocus>
                                    @error('room_name')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="room_desc" class="col-sm-2 col-form-label">RoomDesc</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="room_desc" id="room_desc">{{$room->room_desc}}</textarea>
                                    @error('room_desc')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room_status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="room_status" name="room_status">
                                        <option value="1"{{$room->room_status =='1' ? 'selected' : ''}}>Aailable</option>
                                        <option value="0"{{$room->room_status =='0' ? 'selected': ''}}>Unavilable</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room_type_id" class="col-sm-2 col-form-label">RoomType</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="room_type_id" name="room_type_id">
                                        <option value="">---Choose RoomType---</option>
                                        @foreach ($room_type as $rt)
                                            <option value="{{ $rt->room_type_id }}" {{$room->room_type_id == $rt->room_type_id ? 'selected' : ''}}>{{ $rt->room_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card" style="min-height: 335px;height: auto;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Attachment</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div>
                                        <input class="form-control form-control-lg" name="room_photo" id="room_photo" type="file">
                                    </div>
                                </div>
                                <img src="{{ asset('storage/' . $room->room_photo) }}" width="200">

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-11"></div>
                <div class="col-sm-1">
                    {{-- <button class="btn btn-success">Save</button> --}}

                    <button class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Edit</span>
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection
