@extends('layouts.app', ['activePage' => 'typography', 'titlePage' => __('Category')])

@push('css')
  <link href="{{ asset('material') }}/css/admin/category.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#category" data-toggle="tab">
                  <i class="material-icons">category</i> Category
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#division" data-toggle="tab">
                  <i class="material-icons">line_weight</i> Division
                  <div class="ripple-container"></div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="category">
            <div class="col-12 text-right">
              <button class="btn btn-sm btn-primary" data-target="#categoryModal" data-toggle="modal">Add category</button>
            </div>  
            <table class="table">
              <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th>Category Name</th>
                      <th>Agemin</th>
                      <th>AgeMax</th>
                      <th class="text-right">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                @foreach ( $category as $item )
                  <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->age_min}}</td>
                      <td>{{$item->age_max}}</td>
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
          <div class="tab-pane" id="division">
          <div class="col-12 text-right">
              <button class="btn btn-sm btn-primary reg-division" data-target="#divisionModal" data-toggle="modal">Add division</button>
            </div>  
            <table class="table">
              <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th>Category name</th>
                      <th>Gender</th>
                      <th>Weight</th>
                      <th class="text-right">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                @foreach ( $division as $item )
                  <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->gender}}</td>
                      <td>{{$item->weight}}</td>
                      <td class="td-actions text-right">
                        
                        <button type="button" rel="tooltip" class="btn btn-success" onclick="updateDv({{$item}})">
                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger" onclick="destroyDv({{$item->id}})">
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

<div id="categoryModal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Category Register</h4>
              <p class="card-category"> Please insert new category data</p>
            </div>
            <form method="post" action="{{ route('category.create') }}" id="categoryEdit">
              <div class="card-body">
                @csrf
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">category</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="name" id="categoryName" placeholder="category name">
                </div>
                <div id="sliderDouble" class="slider slider-rose"></div>
                <input type="number" name="age_min" required="true" id="age_min" class="hide">
                <input type="number" name="age_max" required="true" id="age_max" class="hide">
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

<div id="divisionModal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Division Register</h4>
              <p class="card-category"> Please insert new division data</p>
            </div>
            <form method="post" action="{{route('division.create')}}" id="divisionForm">
              <div class="card-body">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <select class="selectpicker" id="select-category" item="categoryId" data-style="btn btn-primary btn-round" title="Category">
                    @foreach ( $category as $item )
                      <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                    </select>
                    <input type="number" name="categoryId" id="categoryId" class="hide">
                  </div>
                  <div class="col-sm-6">
                    <select class="selectpicker" id="select-gender" name="gender" data-style="btn btn-primary btn-round" title="Gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                    <input type="number" name="gender" id="gender" class="hide">
                  </div>
                </div>
                
                <div class="spacing-30"></div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">fitness_center</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="weight" placeholder="Weight kg..." id="weight">
                </div>
                <div class="spacing-30"></div>
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
    var errors = `<?php echo $errors ?>`;
    var success = `<?php echo Session::get('success')?>`;
    var action_url = `<?php echo route('category') ?>`;
    var dv_url = `<?php echo route('division')?>`;
  </script>
  <script src="{{ asset('material/js/admin/category.js') }}"></script>
@endpush