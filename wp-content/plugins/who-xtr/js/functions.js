// Extractor Pro JavaScript Document

function getEmails(fields, $){
	var xhr = $.ajax({
				  type		:	"post",
				  data		:	{
					  action : "hwextpro_ajax_actions",
					  hwextpro_load : "get-emails",
					  file : $("#extract").attr("data-file"),
					  from : $("#extract").attr("data-from"),
					  s_fields : fields
			  },
		  
				  dataType	:	"json",
				  url			:	ajaxurl,
				  beforeSend		:	function(){
			  },
				  success		:	function(data){
					  if(data.error){
						  xhr.abort();
						  $('#status').removeClass("progress-striped active").css("display", "none");
						  $(".btn-load").button("reset");
						  alert(data.error);
					  }
		  
					  else if(data.action == "stop"){
						  $('#status .progress-bar').css("width", data.extracted + "%").html('<span class="sr-only">'+data.extracted+'% Complete</span>');
						  xhr.abort();
						  
						  //Download File
						  var downPath = pluginUrl+"includes/download-data.php?file="+Base64.encode($("#extract").attr("data-file"));;
						  if(fields.length > 1){
							  downPath = pluginUrl+"includes/download-data-csv.php?file="+Base64.encode($("#extract").attr("data-file"));
						  }
						  $("#extract").button("reset").css("display","none");
						  $("#download").attr("href", downPath).css("display", "block");
						  
						  alert("Extraction Completed");
						  $('#status').removeClass("progress-striped active").css("display", "none");
					  }
		  
					  else if(data.action == "cont"){
						  if(data.extracted == 0 && exrtd <= 2){
							  $('#status .progress-bar').css("width", exrtd + "%").html('<span class="sr-only">'+exrtd+'% Complete</span>');
							  exrtd = exrtd + 0.1;
						  }
						  else{
							  $('#status .progress-bar').css("width", data.extracted + "%").html('<span class="sr-only">'+data.extracted+'% Complete</span>');
						  }
						  
						  getEmails(fields, $);
					  }
				  }
			  });
}




/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/
var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	
	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
	
		input = Base64._utf8_encode(input);
	
		while (i < input.length) {
	
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
	
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
	
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
	
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
	
		}
	
		return output;
	},
	
	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
	
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
	
		while (i < input.length) {
	
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
	
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
	
			output = output + String.fromCharCode(chr1);
	
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
	
		}
	
		output = Base64._utf8_decode(output);
	
		return output;
	
	},
	
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
	
		for (var n = 0; n < string.length; n++) {
	
			var c = string.charCodeAt(n);
	
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
	
		}
	
		return utftext;
	},
	
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
	
		while ( i < utftext.length ) {
	
			c = utftext.charCodeAt(i);
	
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
	
		}
	
		return string;
	}

}