@extends('layouts.app', ['activePage' => 'change', 'titlePage' => __('Change Option')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/event_out.css" rel="stylesheet"/>
@endpush
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-warning">
      <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#event_out" data-toggle="tab">
                  <i class="material-icons">event_note</i> Event_out
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#leagueTab" data-toggle="tab">
                  <i class="material-icons">groups</i> League
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#weight" data-toggle="tab">
                  <i class="material-icons">fitness_center</i> Weight
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#category" data-toggle="tab">
                  <i class="material-icons">category</i> Category
                  <div class="ripple-container"></div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        @CSRF
        <div class="tab-content">
          <div class="tab-pane active" id="event_out">
            <div class="row">
              <div class="col-md-4">
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
                <select class="selectpicker" id="league" item="league" data-style="btn btn-warning btn-round" title="League">
                @foreach($leagues as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <hr>
            <div class="list">
              
            </div>
          </div>
          <div class="tab-pane" id="leagueTab">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group col-md-">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">person_search</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="searchChange" placeholder="please insert competitor's name...">
                </div>
              </div>
              <div class="col-md-3">
                <select class="selectpicker" id="leagueChange" item="leagueChange" data-style="btn btn-warning btn-round" title="League">
                @foreach($leagues as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>League</th>
                    <th class="text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="table_league">
                
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="weight">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group col-md-">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">person_search</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="searchWeight" placeholder="please insert competitor's name...">
                </div>
              </div>
              <div class="col-md-3">
                <select class="selectpicker" id="categoryWeight" item="categoryWeight" data-style="btn btn-primary btn-round" title="Category">
                @foreach($category as $index => $item)
                  <option value="{{$item->id}}" {{$index == 0 ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="selectpicker" id="genderWeight" item="genderWeight" data-style="btn btn-primary btn-round" title="Gender">
                  <option value="1" selected>Male</option>
                  <option value="2">Female</option>
                </select>
              </div>
              <div class="col-md-2 weight">
                <select class="selectpicker" id="weightChange" item="weightChange" data-style="btn btn-primary btn-round" title="Weight">
                  <?php $count = 1 ?>
                  @foreach($division as $index => $item)
                    @if($category[0]->id == $item->categoryId && $item->gender == 1)
                      <option value="{{$item->id}}" {{$count == 1 ? 'selected':''}} >{{$item->weight}}</option>
                      <?php $count++; ?>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Category</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th class="text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="table_weight">
                
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="category">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group col-md-">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">person_search</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="searchCategory" placeholder="please insert competitor's name...">
                </div>
              </div>
              <div class="col-md-3">
                <select class="selectpicker" id="categoryCategory" item="categoryCategory" data-style="btn btn-primary btn-round" title="Category">
                @foreach($category as $index => $item)
                  <option value="{{$item->id}}" {{$index == 0 ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="selectpicker" id="genderCategory" item="genderCategory" data-style="btn btn-primary btn-round" title="Gender">
                  <option value="1" selected>Male</option>
                  <option value="2">Female</option>
                </select>
              </div>
              <div class="col-md-2 category">
                <select class="selectpicker" id="categoryChange" item="categoryChange" data-style="btn btn-primary btn-round" title="Weight">
                  <?php $count = 1 ?>
                  @foreach($division as $index => $item)
                    @if($category[0]->id == $item->categoryId && $item->gender == 1)
                      <option value="{{$item->id}}" {{$count == 1 ? 'selected':''}} >{{$item->weight}}</option>
                      <?php $count++; ?>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Category</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th class="text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="table_category">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="leagueModal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">League change</h4>
              <p class="card-category"> Please select league</p>
            </div>
              <div class="card-body">
                <select class="selectpicker" id="leagueSelectModal" item="leagueModal" data-style="btn btn-warning btn-round" title="League">
                @foreach($leagues as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
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

<div id="leaguePersonModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">League History</h4>
              <p class="card-category"> It shows history</p>
            </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Original League</th>
                        <th class="text-right">Changed League</th>
                    </tr>
                  </thead>
                  <tbody class="table_league_history">
                    
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                  OK
                </button>
              </div>
          </div>
      </div>
    </div>
</div>

<div id="weightModal" class="modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Weight Change</h4>
            <p class="card-category"> please select weight</p>
          </div>
          <div class="card-body">
            <div class="row weightModal">
              {{-- <span class="now_weight"></span>=> --}}
              <select class="selectpicker" id="weightSelectModal" item="weightModal" data-style="btn btn-primary btn-round" title="Weight">
                <?php $count = 1 ?>
                @foreach($division as $index => $item)
                  @if($category[0]->id == $item->categoryId && $item->gender == 1)
                    <option value="{{$item->id}}" {{$count == 1 ? 'selected':''}} >{{$item->weight}}</option>
                    <?php $count++; ?>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer">
            <div class="saveWeight">
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
<div id="weightPersonModal" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">League History</h4>
            <p class="card-category"> It shows history</p>
          </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Original Weight</th>
                      <th>Changed Weight</th>
                  </tr>
                </thead>
                <tbody class="table_weight_history">
                  
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                OK
              </button>
            </div>
        </div>
    </div>
  </div>
</div>

<div id="categoryModal" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Category Change</h4>
            <p class="card-category"> please select category</p>
          </div>
          <div class="card-body">
            <div class="row categoryModal">
              <div class="row">
                <div class="col-md-6">
                  <select class="selectpicker" id="categoryCategoryModal" item="categoryCategoryModal" data-style="btn btn-primary btn-round" title="Category">
                  @foreach($category as $index => $item)
                    <option value="{{$item->id}}" {{$index == 0 ? 'selected' : '' }}>{{$item->name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="col-md-6 categoryModalweight">
                  <select class="selectpicker" id="categoryChangeModal" item="categoryChangeModal" data-style="btn btn-primary btn-round" title="Weight">
                    <?php $count = 1 ?>
                    @foreach($division as $index => $item)
                      @if($category[0]->id == $item->categoryId && $item->gender == 1)
                        <option value="{{$item->id}}" {{$count == 1 ? 'selected':''}} >{{$item->weight}}</option>
                        <?php $count++; ?>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="saveCategory">
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
<div id="categoryPersonModal" class="modal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Category History</h4>
            <p class="card-category"> It shows history</p>
          </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Weight</th>
                      <th>Changed Category</th>
                      <th>Changed Weight</th>
                  </tr>
                </thead>
                <tbody class="table_category_history">
                  
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                OK
              </button>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    var leagues = `<?php echo $leagues ?>`;
    var img_url = `<?php echo asset('upload/competitors') ?>`;
    var img_league = `<?php echo asset('upload/league') ?>`;
    var category = `<?php echo $category ?>`;
    var division = `<?php echo $division ?>`;
  </script>
  <script src="{{asset('material/js/admin/event_out.js')}}"></script>
@endpush
