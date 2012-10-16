<!-- BEGIN: MAIN -->
/**
 * Clears value of element with Id
 * @param id - ID of input field
 */
function sl_clear(id){
	var el = document.getElementById(id);
	if (el) el.value='';
}

/**
 * Toggle item in list
 * @param item - item name (string)
 * @param id - ID of target input field
 */
function sl_toggle(item,id){
	var el = document.getElementById(id),
		val = el.value,
		arr = val.split(','),
		exists = false,
		newarr = [];
	for(var i=0; i<arr.length; i++) {
		if (arr[i]==item) exists = true;
		else newarr.push(arr[i]);
	}
	if (!exists) {
		el.value = val ? val + ',' + item : item;
	} else {
		el.value = newarr.join(',');
	}
}

<!-- IF {PHP.cfg.jquery} -->
function extend_ui(){
	// links multiselect with hidden text input field
	$('select.multiselect').bind('change',function(e){
		var id = $(this).data('targetId');
		$('#'+id).val($(this).val().join());
	});

	// links checklistbox with hidden text input field
	$('input.checklistbox').bind('change',function(e){
		var id = $(this).data('targetId');
		var list = [];
		$("input[name^="+id+"_source]:checked").each(function(i,e){
			list.push($(e).val());
		});
		$('#'+id).val(list.join());
	});
	$('#saveconfig table tr').eq(2).hide();
	$('#saveconfig table tr').eq(3).hide();
}

$(function() {
	extend_ui();
	ajaxSuccessHandlers.push(function (){
		extend_ui(); // after pressing reset or update button
	});
});
<!-- ENDIF -->
<!-- END: MAIN -->
