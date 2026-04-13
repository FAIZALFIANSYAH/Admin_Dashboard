@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div></div></div></div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      @foreach($stat as $item)
      <div class="col-lg-3 col-6">
        <div class="small-box bg-{{ $item->color }}">
          <div class="inner">
            <h3>{{ $item->value }}</h3>
            <p>{{ $item->label }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-{{ $item->icon }}"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row">
      <section class="col-lg-7 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Sales
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content p-0">
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
               </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
</div>
            </div>
          </div>
        </div>

        <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>
            <div class="card-tools">
              <span title="3 New Messages" class="badge badge-primary">3</span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="direct-chat-messages">
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                </div>
                <img class="direct-chat-img" src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="message user image">
                <div class="direct-chat-text">Is this template really for free?</div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <form action="#" method="post">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                  <button type="button" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </section>

      <section class="col-lg-5 connectedSortable">
        <div class="card bg-gradient-primary">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-map-marker-alt mr-1"></i>
              Visitors
            </h3>
          </div>
          <div class="card-body">
            <div id="world-map" style="height: 250px; width: 100%;"></div>
          </div>
        </div>

        <div class="card bg-gradient-success">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="far fa-calendar-alt"></i>
              Calendar
            </h3>
          </div>
          <div class="card-body pt-0">
            <div id="calendar" style="width: 100%"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
<div style="display: none;">
    <div id="sparkline-1"></div>
    <div id="sparkline-2"></div>
    <div id="sparkline-3"></div>

    <div id="revenue-map"></div>

    <input type="text" class="knob" id="knob-1">
    <input type="text" class="knob" id="knob-2">
    <input type="text" class="knob" id="knob-3">
    <input type="text" class="knob" id="knob-4">
</div>
@endsection