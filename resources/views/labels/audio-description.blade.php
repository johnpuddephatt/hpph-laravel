@if($is_link ?? false)
  <a href="/tag/AD"
@else
  <span
@endif
title="Audio description available" class="label label--audio-described">AD
@if($is_link ?? false)
  </a>
@else
  </span>
@endif