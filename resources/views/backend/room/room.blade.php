@extends('backend.layouts.master')
@section('title', 'Room')
@section('room', 'show')
@section('Content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">ROOM INFORMATION</h1>
        {{-- Start_Search --}}
        <div class="col-md-4 col-lg-3 mr-auto ">
            <form action="{{url('room/search')}}" class="form-inline">
                <div class="input-group w-100">
                    <input type="text"  name="q_search" value="{{ $data['q_search'] ?? '' }}" class="form-control bg-light border-0 small flex-grow-1" placeholder="Search for...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        {{-- END_Search --}}
        @component('components.alert')
            
        @endcomponent

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Room</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background-color: rgb(0, 139, 139);color: aliceblue">
                                <th>#</th>
                                <th>RoomPhoto</th>
                                <th>RoomName</th>
                                <th>RoomDesc</th>
                                <th>Status</th>
                                <th>RoomPrice</th>
                                <th>RoomType</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            {{-- <tr>
                            <th>#</th>
                            <th>RoomName</th>
                            <th>RoomDesc</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr> --}}
                        </tfoot>
                        <tbody>
                            @php($i = 1)
                            @foreach ($roomlist as $item)
                                <tr>
                                    <td>{{ $roomlist->firstItem() + $loop->index }}</td>
                                    <td><img src="{{ asset('storage/' . $item->room_photo) }}" width="100"></td>
                                    <td>{{ $item->room_name }}</td>
                                    <td>{{ $item->room_desc }}</td>
                                    <td>{{ $item->room_status }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->room_type_name }}</td>
                                    <td>
                                        <a href="{{ route('room.edit', $item->room_id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-info"><i class="fas fa-eye"></i></button>
                                        <a href="{{ url('room/delete/' . $item->room_id) }}" class="btn btn-danger"
                                            onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   

                    {{ $roomlist->appends(request()->except('page'))->links('vendor.pagination.custome')}}
                    
                </div>
            </div>
        </div>
    </div>
@endsection
