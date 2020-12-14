@extends('layouts.master')

@section('content')
    <div class="right_col" role="main">

        <br />
        <div class="">
                        <div class="count">BALANCE: EUR. {{ number_format($bal->value, 2) }}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Transfer <small>Report</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Account No</th>
                                    <th>Receiver</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($transfer as $tf)
                                    <tr>
                                        <td>{{$tf->account}}</td>
                                        <td>{{$tf->receiver}}</td>
                                        <td>{{$tf->value}}</td>
                                        <td>{{date('d F, Y', strtotime($tf->created_at))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Deposit <small>Report</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Ammount</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deposit as $tf)
                                    <tr>
                                        <td>{{$tf->value}}</td>
                                        <td>{{date('d F, Y', strtotime($tf->created_at))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


