// HWCT JavaScript Document

//GLOBALS
var stgrp, stpgs, xhr;
  
jQuery(document).ready(function($){
	//Remove Main Loader
	window.addEventListener('load', function(){
		$("body").removeClass("preload");
	});
	
	//Save Search
	$("#save_search").click(function(e){
		
		var keywords = $.trim($('input[name="query"]').val());
		
		var formGroup = $('input[name="query"]').parents(".form-group");
		formGroup.removeClass("has-error");
		var helpBlock = formGroup.find(".help-block");
		helpBlock.html("");
		$(".alert").remove();
		
		if(!keywords || keywords == ""){
			helpBlock.html("Please Enter Keyword");
			formGroup.addClass("has-error");
			return false;
		}
		
	});
	
	//Delete Search
	$(".delSearch").click(function(e){
		if(confirm("Are you want to delete this search")){
			return;
		}
		return false;
	});
	
	
	//Start Fetching id's
	$("#startFetching").click(function(){
        $(this).button('loading');
		$.ajax({
			type		:	"post",
			data		:	{
				action	:	"hwho_ajax_actions",
				hwct_load : "statusChange",
				wctfm	:	"new",
				wctto :	 "cont"
			},
			dataType	:	"json",
			url			:	ajaxurl,
			beforeSend		:	function(){
				$("#searchProg").html('<pre></pre>');
			},
			success		:	function(output){
				if(output.success){
					$("#btnContl").html('<div class="btn-group"><button id="pauseSearch" type="button" class="btn btn-default">Pause</button><button id="resumeSearch" type="button" class="btn btn-default" disabled="disabled">Resume</button><button id="stopSearch" type="button" class="btn btn-default">Stop</button></div>');
					//start group fetching
					statusUpdates("cont", $);
				}
			}
		});
	});
	
	
	//Pause Search
	$("#btnContl").on("click", "#pauseSearch", function(){
		$(this).attr("disabled", true);
		$.ajax({
			type		:	"post",
			data		:	{
				action	:	"hwho_ajax_actions",
				hwct_load : "statusChange",
				wctfm	:	"cont",
				wctto :	 "pause"
			},
			dataType	:	"json",
			url			:	ajaxurl,
			beforeSend		:	function(){
			},
			success		:	function(output){
				if(output.success){
					(xhr) ? xhr.abort() : "";
					$("#resumeSearch").attr("disabled", false);
					$("#fetchCntrl").html('<a href="'+pluginUrl+'includes/download-data.php" class="btn btn-primary btn-lg btn-block" style="width: 250px; margin: 0px auto 30px;">Download</a>');
				}
				
				if(output.error){
					alert(output.error);
				}
			}
		});
	});
	
	//Stop Search
	$("#btnContl").on("click", "#stopSearch", function(){
		if(!confirm("Are you want to stop the current search process")){
			return;
		}
		var elem = $(this);
		elem.attr("disabled", true);
		
		$.ajax({
			type		:	"post",
			data		:	{
				action	:	"hwho_ajax_actions",
				hwct_load : "statusChange",
				wctto :	 "stop"
			},
			dataType	:	"json",
			url			:	ajaxurl,
			beforeSend		:	function(){
			},
			success		:	function(output){
				if(output.success){
					(xhr) ? xhr.abort() : "";
					elem.parents(".btn-group").remove();
					$("#fetchCntrl").html('<a href="'+pluginUrl+'includes/download-data.php" class="btn btn-primary btn-lg btn-block" style="width: 250px; margin: 0px auto 30px;">Download</a>');
				}
				
				if(output.error){
					alert('Search campaign might be already stoped or some error occurred.');
				}
			}
		});
	});
	
	//Resume Search
	$("#btnContl").on("click", "#resumeSearch", function(){
		var elem = $(this);
		elem.attr("disabled", true);
		
		$.ajax({
			type		:	"post",
			data		:	{
				action	:	"hwho_ajax_actions",
				hwct_load : "resume-search"
			},
			dataType	:	"json",
			url			:	ajaxurl,
			beforeSend		:	function(){
			},
			success		:	function(output){
				if(output.success){
					$("#pauseSearch").attr("disabled", false);
					switch(output.success){
						case "groups":
							groupsMembers("cont", $);
							break;
						case "pages":
							pageMembers("cont", $);
							break;
						case "stup":
							statusUpdates("cont", $);
							break;
					}
				}
				if(output.error){
					alert(output.error);
				}
			}
		});
	});
  
	
});