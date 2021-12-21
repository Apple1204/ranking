@extends('layouts.app', ['activePage' => 'points', 'titlePage' => __('Points')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/points.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-info">
        <h4 class="card-title ">Points</h4>
        <p class="card-category"> Here you can register point data</p>
      </div>
      <div class="crad-body card-padding">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Photo</th>
              <th>Date</th>
              <th>Event</th>
              <th>Point</th>
              <th>Ranking</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody class="tblAdd">

          </tbody>
        </table>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-info">
        <h4 class="card-title ">Points Search</h4>
        <p class="card-category"> Here you can search to add competitors</p>
      </div>
      <div class="card-body card-width" >
        <div class="col-12 text-right">
          <button class="btn btn-sm btn-primary add">Add</button>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="input-group col-md-">
              <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">person_search</i>
                </span>
              </div>
              <input type="text" class="form-control" id="search" placeholder="please insert competitor's name...">
            </div>
          </div>
          <div class="col-md-3">
            <select class="selectpicker" id="category" item="category" data-style="btn btn-primary btn-round" title="Category">
            @foreach($category as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-2 gender">
            <select class="selectpicker" item="gender" id="gender" data-style="btn btn-primary btn-round" title="Gnder">
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
          </div>
          @CSRF
          <div class="col-md-3 weight">
            <select class="selectpicker" item="weight" id="weight" data-style="btn btn-primary btn-round" title="Weight">
            </select>
          </div>
        </div>
        {{-- <div class="row">
          <div class="input-group col">
            <div class="input-group-prepend">
              <span class="input-group-text">
                  <i class="material-icons">pending_actions</i>
              </span>
            </div>
            <input type="text" id="event_date" class="form-control datepicker" data-toggle="datetimepicker" data-target="#Datetimepicker"/>
          </div>
          <div class="col event">
            <select class="selectpicker" item="event" id="event" data-style="btn btn-primary btn-round" title="Event">
            @foreach($event as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach 
            </select>
          </div>
        </div> --}}
        <hr>
        <div class="spacing-15"></div>
        <div class="row competitorlists">
          <!-- <div class="col ">
            <div class="card-avatar">
              <img src="{{asset('material/img/avatar.jpg')}}" alt="" class="avatar">
              <span class="name">AGBEGNENOU Clarisse </span>
            </div>
          </div> -->
            <!-- <div class="col">
              <div class="rotating-card-container">
                <div class="card card-rotate card-background">
                  <div class="front front-background">
                    <div class="card-body">
                      <div class="card-avatar">
                        <img src="{{asset('material/img/avatar.jpg')}}" alt="" class="avatar">
                        <a class="badge badge-rose">Added</a>
                        <span class="name">AGBEGNENOU Clarisse </span>
                      </div>
                    </div>
                  </div>
                  <div class="back back-background" >
                    <div class="card-body">
                      <div class="footer justify-content-center">
                        <a href="#pablo" class="btn btn-success btn-just-icon btn-fill btn-round btn-wd">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            
        </div>
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
                @CSRF
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">flag_circle</i>
                    </span>
                  </div>
                  <input type="number" class="form-control" min="0" name="point" id="point" placeholder="please insert point">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">grade</i>
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
  <script>
    var success = `<?php echo (Session::get("success")) ?>`;
    var errors = `<?php echo $errors ?>`;
    var division = `<?php echo $division ?>`;
    var category = `<?php echo $category ?>`;
    var eventId = `<?php echo $event ?>`;
    var url = `<?php echo asset('upload/competitors') ?>`;
  </script>
  <script src="{{ asset('material/js/admin/points.js') }}"></script>
@endpush