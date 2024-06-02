@extends('layouts.admin-main')

@section('title')
    <h1>Admin Dashboard</h1>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Monthly Recap Report</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    Add Products to Cart
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="float-right"><b>480</b>/800</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Send Inquiries
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

                  <!-- TABLE: LATEST ORDERS -->
                  <div class="card">
                    <div class="card-header border-transparent">
                      <h3 class="card-title">Latest Orders</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <div class="table-responsive">
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Status</th>
                            <th>Popularity</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge badge-success">Shipped</span></td>
                            <td>
                              <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge badge-danger">Delivered</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-info">Processing</span></td>
                            <td>
                              <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge badge-danger">Delivered</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge badge-success">Shipped</span></td>
                            <td>
                              <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                      <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                    </div>
                    <!-- /.card-footer -->
                  </div>

                             <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recently Added Products</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('/AdminLTE-3.2.0/dist/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Samsung TV
                      <span class="badge badge-warning float-right">$1800</span></a>
                    <span class="product-description">
                      Samsung 32" 1080p 60Hz LED Smart HDTV.
                    </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('/AdminLTE-3.2.0/dist/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Bicycle
                      <span class="badge badge-info float-right">$700</span></a>
                    <span class="product-description">
                      26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                    </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('/AdminLTE-3.2.0/dist/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">
                      Xbox One <span class="badge badge-danger float-right">
                      $350
                    </span>
                    </a>
                    <span class="product-description">
                      Xbox One Console Bundle with Halo Master Chief Collection.
                    </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('/AdminLTE-3.2.0/dist/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">PlayStation 4
                      <span class="badge badge-success float-right">$399</span></a>
                    <span class="product-description">
                      PlayStation 4 500GB Console (PS4)
                    </span>
                  </div>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Products</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
@endsection
