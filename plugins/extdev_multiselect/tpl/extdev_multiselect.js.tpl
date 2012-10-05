<!-- BEGIN: MAIN -->
function sl_clear(id){
	var el = document.getElementById(id);
	if (el) el.value='';
}

function sl_add(item,id){
	var el = document.getElementById(id);
	var val = el.value;
	el.value = val ? val + ',' + item : item;
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

/*$('select.dragsource').each(function(i,e){
	$(e).draggable();
});
*/
//bind('change',function(e){;

//});
//$( ".dragsource option, #droptarget option" ).draggable();
/*$( "#droptarget" ).droppable({
	accept: "option.dnd_left",
	activeClass: "ui-state-hover",
	hoverClass: "ui-state-active",
	drop: function( event, ui ) {
		$( this ).addClass( "ui-state-highlight" );
		console.log('dropped');
	}
});
*/