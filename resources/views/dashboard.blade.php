@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
              <div class="card-icon">
                <i class="material-icons">face</i>
              </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Competitors</h4>
                  - Now <b style="font-size: 18px; color: #9932b1">{{$competitors}}</b> compertitors are registered...
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
              <div class="card-icon">
                <i class="material-icons">festival</i>
              </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Event</h4>
                    -Now <b style="font-size: 18px; color: #e12c6c">{{$event}}</b> events are registered...
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon card-header-warning">
              <div class="card-icon">
                <i class="material-icons">groups</i>
              </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">League</h4>
                    -Now <b style="font-size: 18px; color: #fd9913">{{$leagues}}</b> leagues are registerd...
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush