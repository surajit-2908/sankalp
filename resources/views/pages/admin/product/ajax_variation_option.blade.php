<div class="form-group">
    <label>Variation Option</label>
    <select class="form-control chzn-select select_multiple_vop"
        name="variation_option_string[{{ $dataArr['variation_id'] }}][]" multiple required="">
        <option value="" disabled>Select Variation</option>
        @foreach ($dataArr['variationOptArr'] as $variationOpt)
            <option value="{{ $variationOpt->id }}">{{ $variationOpt->name }}</option>
        @endforeach
    </select>
</div>
<script>
    $(function() {
        $(".chzn-select").chosen({
            allow_single_deselect: true
        });
    });
</script>
