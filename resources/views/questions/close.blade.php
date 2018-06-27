<div class="row justify-content-between col-md-8 mx-auto">
    <div class="head-range">
        <span class="float-left mb-3 d-inline-block">Pas du tout</span>
        <span class="float-right mb-3  d-inline-block">Totalement</span>
    </div>
    <input type="range" min="0" max="5" step="1" name="result" data-first="@if ($result == -1){{1}}@else{{0}}@endif" id="result-range" value="{{ $result }}"  >
    <datalist>
        <option value="0" style="background: transparent;">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5"style="background: transparent;">
    </datalist>
</div>