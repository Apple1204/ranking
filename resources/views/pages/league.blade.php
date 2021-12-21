@extends('layouts.app', ['activePage' => 'league', 'titlePage' => __('League')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/league.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">League List</h4>
            <p class="card-category"> Here you added league list</p>
          </div>
          <div class="card-body">
              
            <div class="col-12 text-right">
              <button class="btn btn-sm btn-primary" data-target="#leagueModal" data-toggle="modal">Add league</button>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Photo</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  @foreach($leagues as $league)
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td>{{ $league->name }}</td>
                        <td>{{ $league->short_name }}</td>
                        <td><img src="{{ asset('upload/league') }}/{{$league->photo}}" class="tbl_photo" alt=""></td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-success" onclick="update({{ $league }})">
                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger" onclick="destroy({{$league->id}})">
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
  </div>
</div>


<div id="leagueModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">League Register</h4>
              <p class="card-category"> Please insert new league data</p>
            </div>
            <form method="post" action="{{ route('league.create') }}" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                @csrf
                  <div class="col-lg-8">
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Name :</label>
                      <div class="col-sm-12">
                        <div class="form-group bmd-form-group is-filled">
                          <input class="form-control" name="name" id="input-name" type="text" required="true" placeholder="Name" aria-required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Short Name :</label>
                      <div class="col-sm-12">
                        <div class="form-group bmd-form-group is-filled">
                          <input class="form-control" name="short_name" id="input-short-name" type="text" required="true" placeholder="Short Name" aria-required="true">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <img alt="" id="photo">
                    <label for="photoFile" class="custom-file-upload">
                      <i class="fa fa-cloud-upload"></i> Select photo
                    </label>
                    <input id="photoFile" type="file" name="photo"/>
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

<div id="editModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">League Register</h4>
              <p class="card-category"> Please insert new league data</p>
            </div>
            <form method="post" id="form-edit" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                @csrf
                  <div class="col-lg-8">
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Name :</label>
                      <div class="col-sm-12">
                        <div class="form-group bmd-form-group is-filled">
                          <input class="form-control" name="name" id="input-name-edit" type="text" required="true" placeholder="Name" aria-required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-3 col-form-label">Short Name :</label>
                      <div class="col-sm-12">
                        <div class="form-group bmd-form-group is-filled">
                          <input class="form-control" name="short_name" id="input-short-edit" type="text" required="true" placeholder="Short Name" aria-required="true">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <img alt="" id="photoEdit">
                    <label for="photoEditFile" class="custom-file-upload">
                      <i class="fa fa-cloud-upload"></i> Select photo
                    </label>
                    <input id="photoEditFile" type="file" name="photo"/>
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
    // var errors = @json($errors);
    var image_url = `<?php echo asset('upload/league') ?>`;
    var action_url = `<?php echo route('league') ?>`
  </script>
  <script src="{{ asset('material/js/admin/league.js') }}"></script>
@endpush