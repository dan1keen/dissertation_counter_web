@extends('app')
@section('title', 'Список')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleFormControlSelect1">Выберите тип графика</label>
                <select class="form-control" id="exampleFormControlSelect1" onchange="handleTypeChange(event)">
                    <optgroup label="HighCharts">
                        <option value="highcharts" @if(request()->get('type') == 'highcharts') selected @endif>(Bar chart)</option>
                        <option value="highcharts_line" @if(request()->get('type') == 'highcharts_line') selected @endif>(Line chart)</option>
                    </optgroup>
                    <optgroup label="Chartisan">
                        <option value="chartisan" @if(request()->get('type') == 'chartisan') selected @endif>(Bar chart)</option>
                        <option value="chartisan_line" @if(request()->get('type') == 'chartisan_line') selected @endif>(Line chart)</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlSelect1">Группировать по</label>
                <select class="form-control" id="exampleFormControlSelect1" onchange="handleDateChange(event)">
                    <option value="clear" @if(request()->get('group') == 'clear') selected @endif>Не группировать</option>
                    <option value="days" @if(request()->get('group') == 'days') selected @endif>Дням</option>
                    <option value="month" @if(request()->get('group') == 'month') selected @endif>Месяцам</option>
                    <option value="years" @if(request()->get('group') == 'years') selected @endif>Годам</option>
                </select>
            </div>
        </div>
        <br>
        <table id="datatable" style="display:none">
            <thead>
            <tr>
                <th></th>
                <th>Пешеход</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th>{{ $item->dateFormat }}</th>
                    <td>{{ $item->passes }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="card" id="card">
            <h5 class="card-header">График</h5>
            <div class="card-body">
                <div class="card-text">
                    <div id="container" style=" margin: 0 auto;">
                        @if($type == 'highcharts' || $type == 'highcharts_line')
                            <script src="http://code.highcharts.com/stock/highstock.js"></script>
                            <script src="https://code.highcharts.com/modules/data.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script src="https://code.highcharts.com/modules/export-data.js"></script>
                            <script>

                                Highcharts.chart('container', {
                                    data: {
                                        table: 'datatable'
                                    },
                                    chart: {
                                        type: '{{ $type == 'highcharts' ? 'column' : 'line' }}'
                                    },
                                    title: {
                                        text: 'Полученные данные в виде Bar Chart'
                                    },
                                    yAxis: {
                                        allowDecimals: false,
                                        title: {
                                            text: 'Кол-во пешеходов'
                                        }
                                    },
                                    xAxis: {
                                        ordinal: true,

                                    },
                                    tooltip: {
                                        formatter: function () {
                                            return '<b>' + this.series.name + '</b><br/>' +
                                                this.point.y;
                                        }
                                    }
                                });
                            </script>
                        @elseif($type == 'chartisan' || $type == 'chartisan_line')
                            <div id="chart" style="height: 300px;"></div>
                            <!-- Charting library -->
                            <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
                            <!-- Chartisan -->
                            <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
                            <script>
                                const chart = new Chartisan({
                                    el: '#chart',
                                    url: "@chart('sample_chart', ['object' => $object, 'items' => json_encode($items)])",
                                    hooks: new ChartisanHooks()
                                        .datasets('{{ $type == 'chartisan' ? 'bar' : 'line' }}')
                                        .tooltip(true)
                                        .colors(),
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5 mb-5">
            <h5 class="card-header">Список</h5>
            <div class="card-body">
                <h5 class="card-title">Пешеходы</h5>
                <div class="card-text">

                    <table id="table" class="table table-hover">
                        <tr>
                            <th>Тип объекта</th>
                            <th>Кол-во</th>
                            <th>Дата и время фиксаций</th>
                        </tr>
                        @foreach($items as $item)
                            <tr id="row">
                                <td>{{ $item->object }}</td>
                                <td>{{ $item->passes }}</td>
                                <td>{{ $item->dateFormat }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{--            <div>--}}
                {{--                <button type="button" class="btn btn-info float-right" id="val" onclick="info()">Показать график</button>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>

    <script>
        function info() {
            let x = document.getElementById("card");
            let btn = document.getElementById("val");
            if (x.style.display === "none") {
                x.style.display = "block";
                btn.innerHTML = "Скрыть график";
            } else {
                x.style.display = "none";
                btn.innerHTML = "Показать график";
            }
        }

        function handleTypeChange(e) {
            location.href = `/list/{{ $object }}?type=${e.target.value}&group={{ $group }}`;
        }
        function handleDateChange(e) {
            location.href = `/list/{{ $object }}?type={{ $type }}&group=${e.target.value}`;
        }
    </script>
@endsection
