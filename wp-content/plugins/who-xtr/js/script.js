// Extractor Pro JavaScript Document

var data = 0, exrtd = 0.1;

jQuery(document).ready(function($){
	$("#extract").click(function(){
		$("#extract").button("loading");
		
		var fields = new Array();
		$(".searchFields:checked").each(function(index, elem){
			fields.push($(this).val());
		});
		
		$('#status').css("display", "block");
		
		var initProg = setInterval(function(){
			$('#status .progress-bar').css("width", exrtd + "%").html('<span class="sr-only">'+exrtd+'% Complete</span>');
			exrtd = exrtd + 0.1;
		},1000);
		
		setTimeout(function(){
			clearInterval(initProg);
		},8000);
		
		
		getEmails(fields, $);
	});

	$(".delete_file").click(function(e) {
		if(!confirm("Are you want to delete this file")){
			return false;
		}
		return;
    });
	
	$("#slider").slider({
		range: "min",
		value: parseInt($(".help-block .text-info").text()),
		min: 200,
		max: 4500,
		slide: function( event, ui ) {
			$("#reqAmount").val(ui.value);
			$(".help-block .text-info").text(ui.value+" Requests");
		}
	});
	
	$("#reqAmount").val($("#slider").slider("value"));
	$(".help-block .text-info").text($("#slider").slider("value")+" Requests");
})