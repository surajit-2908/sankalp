<div class="container_div showSect" style="width:100%;">
    <div class="col-lg-5 col-md-5">
        <div class="form-group">
            <label>Variation
            </label>
            <select class="form-control variation_cls" name="variation_id[]" data-id="{{ $dataArr['unique_id'] }}"
                required="">
                <option value="">Select Variation</option>
                @foreach ($dataArr['variationArr'] as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5">
        <div class="form-group" id="var_opt_div_{{ $dataArr['unique_id'] }}">
            <label>Variation Option</label>
            <select class="form-control" name="variation_option_string[][]">
                <option value="">Select Variation Option</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-2">
        <div class="form-group">
            <label>&nbsp;</label>
            <button style="display:block;" type="button" class="btn btn-danger btn-sm remove">
                <i class="fa fa-times"></i>
            </button>
        </div>

    </div>
</div>

<script>
    $(function() {
        $(".chzn-select").chosen({
            allow_single_deselect: true
        });
    });
    $(document).ready(function() {

        $(document).on('click', '.remove', function() {
            $(this).closest('.container_div').remove();
        });

    });
    $(document).ready(function() {
        $(document).on('change', '.variation_cls', function() {
            let variation_id = $(this).find('option:selected').val();
            let variation_data_id = $(this).attr("data-id");
            let url = "{{ route('admin.get.var.opt', ':slug') }}"
            url = url.replace(":slug", variation_id);
            $.get(url, (response) => {
                $('#var_opt_div_' + variation_data_id).html(response);
            });

        });
    });
</script>
