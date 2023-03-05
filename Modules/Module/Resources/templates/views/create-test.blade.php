@extends('base::layouts.master')
@section('title', __('Create'))

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="form">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Form</h3>
                </div>
                <div class="card-body">
                    
                    <div class="form-group">
                        <label>Name</label>
                        
                        <input type="text" class="form-control" placeholder="Name" />
                        
                    </div>
                    
                    <div class="form-group">
                        <label>Datepicker</label>
                        
                        <div class="input-group datepicker">
                            <input type="text" class="form-control" name="date" readonly="readonly" placeholder="Select date">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label>Time</label>
                        
                        <div class="input-group timepicker">
                            <input class="form-control" name="time" readonly="readonly" type="text" placeholder="Select time">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-clock-o"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label>Date Range</label>
                        
                        <div class="input-group daterangepicker">
                            <input type="text" class="form-control" name="daterange" readonly="readonly" placeholder="Select date range">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
        let arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        $('.datepicker input').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        $('.timepicker input').timepicker({
            minuteStep: 1,
            defaultTime: '',
            showSeconds: true,
            showMeridian: false,
            snapToStep: true
        });

        $('.daterangepicker').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('.daterangepicker .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

    })
</script>
@endpush
