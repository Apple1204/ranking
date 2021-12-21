@extends('layouts.main_layout')

@push('css')
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <link href="{{ asset('material') }}/css/main/main.css" rel="stylesheet"/>
@endpush

@section('content')

    <div class="row">
        @CSRF
        <div class="col-md-2">
            <select class="selectpicker" id="category" name="category" data-style="btn btn-warning" title="Category">
            @foreach ($category as $index => $item)
                <option value="{{$item->id}}" {{$index == 0 ? 'selected':''}} >{{$item->name}}</option> 
            @endforeach
            </select>
            <div class="card">
                <div class="card-body">
                    <table class="division">
                        <tbody>
                            <tr>
                                <td colspan="2" class="active" id="0">All</td>
                            </tr>
                            <tr>
                                <td id="-1">M</td>
                                <td id="-2">F</td>
                            </tr>
                            <tr>
                                <td class="M0"></td>
                                <td class="F0"></td>
                            </tr>
                            <tr>
                                <td class="M1"></td>
                                <td class="F1"></td>
                            </tr>
                            <tr>
                                <td class="M2"></td>
                                <td class="F2"></td>
                            </tr>
                            <tr>
                                <td class="M3"></td>
                                <td class="F3"></td>
                            </tr>
                            <tr>
                                <td class="M4"></td>
                                <td class="F4"></td>
                            </tr>
                            <tr>
                                <td class="M5"></td>
                                <td class="F5"></td>
                            </tr>
                            <tr>
                                <td class="M6"></td>
                                <td class="F6"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-10 card-box">
            <div class="app">
                <form class="toggle">
                    <input type="radio" id="choice1" name="choice" value="creative">
                    <label for="choice1">Simple</label>
                    <input type="radio" id="choice2" name="choice" value="productive">
                    <label for="choice2">Extended</label>
                    <div id="flap"><span class="view">Active</span></div>
                </form>
            </div>
                    
            <select class="selectpicker" id="league" name="league" data-style="btn btn-warning" title="League">
                <option value="0" selected>All</option>
            @foreach ($leagues as $index => $item)
                <option value="{{$item->id}}" >{{$item->name}}({{$item->short_name}})</option>
            @endforeach
            </select>
            <table id="ranking" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead class="ranking-head">
                </thead>
                <tbody class="ranking-body">
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var avatar_url = `<?php echo asset('upload/competitors') ?>`;
        var photo_url = `<?php echo asset('upload/league')?>`;
    </script>
    <script src="{{asset('material')}}/js/main/main.js"></script>
@endpush