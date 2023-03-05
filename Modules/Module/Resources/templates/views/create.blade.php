--at--extends('base::layouts.master')
--at--section('title', __('{{ 'Create' }}'))

--at--section('content')
<div class="row">
    <div class="col-md-6">
        <form class="form">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Form</h3>
                </div>
                <div class="card-body">
                    @foreach($resource['forms'] as $field)

                    <div class="form-group">
                        <label>{{ $field['label'] }}</label>
                        @switch($field['type'])
                        @case('email')

                        <input type="email" class="form-control" placeholder="{{ $field['placeholder'] ?? $field['label'] }}" />
                        @break

                        @case('checkbox')

                        <div class="checkbox-list">
                            <label class="checkbox">
                                <input type="checkbox" name="{{ $field['name'] }}">
                                <span></span>Option 1
                            </label>
                        </div>
                        @break

                        @case('radio')

                        <div class="radio-list">
                            <label class="radio">
                                <input type="radio" name="{{ $field['name'] }}">
                                <span></span>Option 1
                            </label>
                        </div>
                        @break

                        @case('switch')

                        <span class="switch">
                            <label>
                                <input type="checkbox" checked="checked" name="{{ $field['name'] }}">
                                <span></span>
                            </label>
                        </span>
                        @break

                        @case('datepicker')

                        <div class="input-group datepicker">
                            <input type="text" class="form-control" name="{{ $field['name'] }}" readonly="readonly" placeholder="{{ $field['placeholder'] ?? 'Select date' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @break

                        @case('timepicker')

                        <div class="input-group timepicker">
                            <input class="form-control" name="{{ $field['name'] }}" readonly="readonly" type="text" placeholder="{{ $field['placeholder'] ?? 'Select time' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-clock-o"></i>
                                </span>
                            </div>
                        </div>
                        @break

                        @case('daterangepicker')

                        <div class="input-group daterangepicker">
                            <input type="text" class="form-control" name="{{ $field['name'] }}" readonly="readonly" placeholder="Select date range">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @break

                        @case('textarea')

                        <textarea class="form-control" rows="3" name="{{ $field['name'] }}"></textarea>
                        @break

                        @default

                        <input type="text" class="form-control" placeholder="{{ $field['placeholder'] ?? $field['label'] }}" />
                        @endswitch

                    </div>
                    @endforeach

                </div>
            </div>
        </form>
    </div>
</div>
--at--endsection

--at--push('scripts')
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
--at--endpush
