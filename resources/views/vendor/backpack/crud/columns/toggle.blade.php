{{-- togglable checkbox --}}
@php $checkValue = (data_get($entry, $column['name'])); @endphp
@php $checkValue ? ($state = 'deactivate') : ($state = 'activate') @endphp
<input @if($checkValue) checked @endif type="checkbox" href="javascript:void(0)" onclick="toggleValue(this)" data-route="{{ url('/admin/slide/' . $entry->getKey() . '/' . $state ) }}" data-button-type="toggle">

<script>
	if (typeof toggleValue != 'function') {
	  // $("[data-button-type=toggle]").unbind('click');

	  function toggleValue(button) {
	      // ask for confirmation before deleting an item
	      // e.preventDefault();
	      var button = $(button);
	      var route = button.attr('data-route');

	          $.ajax({
	              url: route,
	              type: 'POST',
	              success: function(result) {
	                  // Show an alert with the result
	                  new PNotify({
	                      title: "Success",
	                      text: "Active status toggled",
	                      type: "success"
	                  });


	              },
	              error: function(result) {
	                  // Show an alert with the result
	                  new PNotify({
	                      title: "Error",
	                      text: "Active status could not be toggled",
	                      type: "warning"
	                  });
	              }
	          });

      }
	}
</script>
