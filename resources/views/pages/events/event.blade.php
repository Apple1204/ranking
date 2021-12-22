@extends('layouts.app', ['activePage' => 'event', 'titlePage' => __('Event')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/event.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Event List</h4>
                <p class="card-category"> Here you added event list</p>
            </div>
            <div class="card-body">
                <div class="col-12 text-right">
                    <button class="btn btn-sm btn-primary" data-target="#eventModal" data-toggle="modal">Add league</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th style="width: 70px">Order</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 ?>
                        @foreach($event as $item)
                            <tr>
                                <td class="text-center">{{ $i }}</td>
                                <td>{{ $item->name }}</td>
                                <td><input type="number" class="form-control order{{$item->id}}" value={{$item->order}} min="0" onChange="updateOrder({{$item}})"></td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-success" onclick="update({{ $item }})">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger" onclick="destroy({{$item->id}})">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="eventModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Event Register</h4>
              <p class="card-category"> Please insert new event data</p>
            </div>
            <form method="post" action="{{ route('event.create') }}" id="form-edit">
              <div class="card-body">
                <div class="row">
                @csrf
                      <label class="col-sm-3 col-form-label">Name :</label>
                      <div class="col-sm-12">
                        <div class="form-group bmd-form-group is-filled">
                          <input class="form-control" name="name" id="input-name" type="text" required="true" placeholder="Name" aria-required="true">
                        </div>
                      </div>
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                  SAVE
                </button>
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                  CLOSE
                </button>
              </div>
            </form>
          </div>
      </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        var success = `<?php echo (Session::get("success")) ?>`;
        var errors = `<?php echo $errors ?>`;
        var update_url = `<?php echo route('event') ?>`;
    </script>
    <script src="{{ asset('material/js/admin/event.js') }}"></script>
@endpush