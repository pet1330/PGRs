<div class="col-lg-3 col-md-3">
    <h4>Current year</h4>
    <div class="flot-chart">
        <div class="flot-chart-content" id="current_year_chart"></div>
    </div>
</div>
<div class="col-lg-3 col-md-3">
    <h4>Enrolment status</h4>
    <div class="flot-chart">
        <div class="flot-chart-content" id="enrolment_status_chart"></div>
    </div>
</div>
<div class="col-lg-3 col-md-3">
    <h4>Awards</h4>
    <div class="flot-chart">
        <div class="flot-chart-content" id="awards_chart"></div>
    </div>
</div>
<div class="col-lg-3 col-md-3">
    <h4>Mode of study</h4>
    <div class="flot-chart">
        <div class="flot-chart-content" id="mode_of_study_chart"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        var current_year_chart_data = [
        @foreach ($current_year_stats as $stat)
        {
            label: "Year {{ $stat->year }}",
            data: {{ $stat->count }}
        },
        @endforeach
        ];
        $.plot($("#current_year_chart"), current_year_chart_data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series) {
                            return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                        },
                        background: {
                            opacity: 0.8,
                            color: '#444'
                        },
                        threshold: 0.1
                    }
                }
            },
            legend: {
                show: false
            }
        });

        var enrolment_status_chart_data = [
        @foreach ($enrolment_status_stats as $stat)
        {
            label: "{{ $stat->name }}",
            data: {{ $stat->count }}
        },
        @endforeach
        ];
        $.plot($("#enrolment_status_chart"), enrolment_status_chart_data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series) {
                            return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                        },
                        background: {
                            opacity: 0.8,
                            color: '#444'
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });

        var awards_chart_data = [
        @foreach ($award_stats as $stat)
        {
            label: "{{ $stat->name }}",
            data: {{ $stat->count }}
        },
        @endforeach
        ];
        $.plot($("#awards_chart"), awards_chart_data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series) {
                            return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                        },
                        background: {
                            opacity: 0.8,
                            color: '#444'
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });

        var mode_of_study_chart_data = [
        @foreach ($mode_of_study_stats as $stat)
        {
            label: "{{ $stat->name }}",
            data: {{ $stat->count }}
        },
        @endforeach
        ];
        $.plot($("#mode_of_study_chart"), mode_of_study_chart_data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series) {
                            return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                        },
                        background: {
                            opacity: 0.8,
                            color: '#444'
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });
    });
</script>