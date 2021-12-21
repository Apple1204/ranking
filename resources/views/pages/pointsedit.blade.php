@extends('layouts.app', ['activePage' => 'pointsedit', 'titlePage' => __('Points Edit')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/pointsedit.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-info">
        <h4 class="card-title ">Points</h4>
        <p class="card-category"> Here you can register point data</p>
      </div>
      <div class="crad-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Photo</th>
              <th>Date</th>
              <th>Event</th>
              <th>League</th>
              <th>Category</th>
              <th>Weight</th>
              <th>Point</th>
              <th>Ranking</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody class="tbl-data">
            @foreach ($points as $index => $item)
                <tr class="{{$item->id}}">
                  <td class="text-center">{{$index+1}}</td>
                  <td>{{$item->first_name}} {{$item->last_name}}</td>
                  <td><img src="{{asset('upload/competitors')}}/{{$item->photo}}" alt="" id="avatar"></td>
                  <td class="date">{{$item->date}}</td>
                  <td class="event">{{$item->event}}</td>
                  <td>{{$item->leauge}}</td>
                  <td>{{$item->category}}</td>
                  <td>{{$item->weight}}</td>
                  <td class="point">{{$item->point}}</td>
                  <td  class="ranking">{{$item->ranking}}</td>
                  <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-success" onclick="showModal({{ $item }})">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" rel="tooltip" class="btn btn-danger" onclick="destroy({{$item->id}})">
                        <i class="material-icons">close</i>
                    </button>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="pointsModal" class="modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Points</h4>
            <p class="card-category"> Please insert points</p>
          </div>
            <div class="card-body">
              <div class="input-group col">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">pending_actions</i>
                      &nbsp;
                      Date :
                  </span>
                </div>
                <input type="text" id="event_date" class="form-control datepicker" data-toggle="datetimepicker" data-target="#Datetimepicker"/>
              </div>
              <div class="col event">
                {{-- Event :
                &nbsp; --}}
                <select class="selectpicker" item="event" id="event" data-style="btn btn-primary btn-round" title="Event">
                @foreach($events as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach 
                </select>
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">flag_circle</i>
                      &nbsp;
                      Point :
                  </span>
                </div>
                <input type="number" class="form-control" min="0" name="point" id="pt" placeholder="please insert point">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">grade</i>
                      &nbsp;
                      Ranking :
                  </span>
                </div>
                <input type="number" class="form-control" name="ranking" id="ranking" min="1" placeholder="please insert ranking">
              </div>
            </div>
            <div class="card-footer">
              <div class="save">
                <button class="btn btn-primary">
                  SAVE
                </button>
              </div>
              <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                CLOSE
              </button>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script src="{{ asset('material/js/admin/pointsedit.js') }}"></script>
@endpush