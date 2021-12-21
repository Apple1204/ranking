@extends('layouts.app', ['activePage' => 'competitors', 'titlePage' => __('Competitors')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/competitors.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Competitors List</h4>
          <p class="card-category"> Here you added competitors list</p>
      </div>
      <div class="card-body">
        <div class="col-12 text-right">
          <button class="btn btn-sm btn-primary" data-target="#competitorsModal" data-toggle="modal">Add competitor</button>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                  <th class="text-center">#</th>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>League</th>
                  <th>Gender</th>
                  <th>Category</th>
                  <th>weight</th>
                  <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 ?>
              @foreach($competitors as $item)
                <tr>
                  <td class="text-center">{{$i}}</td>
                  <td>{{$item->first_name}} {{$item->last_name}}</td>
                  <td><img src="{{asset('upload/competitors')}}/{{$item->photo}}" alt="" id="avatar"></td>
                  <td><img src="{{asset('upload/league')}}/{{$item->image}}" alt="" id="flag"> {{$item->short_name}}</td>
                  <td>{{$item->gender}}</td>
                  <td>{{$item->cname}}</td>
                  <td>{{$item->weight}}</td>
                  <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-success" onclick="update({{ $item }})">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" rel="tooltip" class="btn btn-danger" onclick="destroy({{$item->id}})">
                        <i class="material-icons">close</i>
                    </button>
                  </td>
                </tr>
                <?php $i ++ ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="competitorsModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Competitor Register</h4>
              <p class="card-category"> Please insert new competitor data</p>
            </div>
            <form method="post" id="form-edit" action="{{ route('competitors.create') }}" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                @csrf
                  <div class="col-md-4">
                    <div class="spacing-15"></div>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-circle img-raised">
                        <img src="{{asset('material/img/avatar.jpg')}}" alt="..." id="editAvatar">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised avatar"></div>
                      <div>
                        <span class="btn btn-raised btn-round btn-rose btn-file">
                          <span class="fileinput-new">Add Photo</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="photo" />
                        </span>
                        <br />
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="spacing-30"></div>
                    <div class="row">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="First name" name="first_name" id="first_name">
                      </div>
                      <div class="col">
                        <input type="text" class="form-control" placeholder="Last name" name="last_name" id="last_name">
                      </div>
                    </div>
                    <div class="spacing-15"></div>
                    <div class="row">
                      <div class="form-group col-sm-5">
                        <label for="gender">Gender select</label>
                        <select class="form-control selectpicker" data-style="btn btn-link" id="gender" item="gender">
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                        <input type="text" class="hide gender" name="gender" value="1">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <select class="selectpicker" id="category" item="category" data-style="btn btn-primary btn-round" title="Category">
                          @foreach($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-5">
                        <select class="selectpicker" item="division" id="weight" data-style="btn btn-primary btn-round" title="Weight">
                        </select>
                        <input type="text" class="hide weight" name="divisionId">
                      </div>
                    </div>
                    <div class="spacing-15"></div>
                    <select class="selectpicker" id="league" item="league" data-style="btn btn-primary btn-round" title="League">
                      @foreach($league as $item)
                        <option value="{{$item->id}}">{{$item->name}}({{$item->short_name}})</option>
                      @endforeach
                    </select>
                    <input type="text" class="hide league" name="leagueId">
                  </div>
                </div>
                <div class="spacing-15"></div>
                <div class="card-footer">
                  <button class="btn btn-primary" type="submit">
                    SAVE
                  </button>
                  <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    CLOSE
                  </button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
</div>

@endsection

@push('js')
<script>
    var errors = `<?php echo $errors ?>`;
    var success = `<?php echo Session::get('success')?>`;
    var action_url = `<?php echo route('competitors') ?>`;
    var img_url = `<?php echo asset('upload/competitors') ?>`;
    var category = `<?php echo $category ?>`;
    var division = `<?php echo $division ?>`;
</script>
<script src="{{ asset('material/js/admin/competitors.js') }}"></script>
@endpush