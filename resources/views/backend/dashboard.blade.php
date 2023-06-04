@extends('backend.master')

@section('content')

 <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-9">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">Account Overview</h4>
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->
                       </div> <!-- content -->         


@endsection
@section('footer_js')

        <script src="/js/highcharts.js"></script>
<script src="/js/modules/stock.js"></script>
<script src="/js/modules/map.js"></script>
<script src="/js/highstock.js"></script>
<script src="/js/highmaps.js"></script>
<script src="/js/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
    {{ $chart->script() }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

    
@endsection