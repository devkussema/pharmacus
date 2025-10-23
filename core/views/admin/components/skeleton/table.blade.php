@php($rows = $rows ?? 6)
<div class="card p-3">
  <div class="skeleton mb-3" style="height:24px;width:30%"></div>
  @for($i=0;$i<$rows;$i++)
    <div class="d-flex gap-3 mb-2">
      <div class="skeleton" style="height:16px;flex:0 0 60px"></div>
      <div class="skeleton" style="height:16px;flex:1"></div>
      <div class="skeleton" style="height:16px;flex:0 0 160px"></div>
    </div>
  @endfor
</div>
