$(document).ready(function($) {
	"use strict";	
	if($('#form-item').length > 0){
		$(document).on('click', '#add', function(event) {
			var input = $('input[name="action"]').val().replace ( /[^\d.]/g, '' );
			var length = $('.text-red:first input').length;
			$('input.style-margin').each(function(index, el) {						
				var $clones = $('<div/>').append($(this).last().clone()).html();
				var attr = $(this).attr('name').match(/([\w\_]+)(\[(\d{1,})\])/);
				var new_id = parseInt(attr[3])+1;
				if(isNaN(input) == false && parseInt(input) > 0){
					for( var i = parseInt(length) ; i<= parseInt(input)+parseInt(length)-1 ; i++ ){
						var content = $clones.replace($(this).attr('name'),attr[1]+"["+(i)+"]");			
						if($('input[name="'+attr[1]+'['+i+']"]').length == 0){						
							$( content ).insertAfter( $('input[name="'+attr[1]+'['+(parseInt(i)-1)+']"]') );
						}
					}
				}else{
					var content = $clones.replace($(this).attr('name'),attr[1]+"["+(new_id)+"]");			
					if($('input[name="'+attr[1]+'['+new_id+']"]').length == 0){
						$( content ).insertAfter( $( this ) );
					}
				}
			});
		});
		$(document).on('click', '#remove', function(event) {
			var item 	= new Array;		
			var oc 		= {};
			var input 	= $('input[name="action"]').val().replace ( /[^\d.]/g, '' );
			var length = $('.text-red:first input').length;
			$('input.style-margin').each(function(index, el) {
				item[index] = $(this).attr('data-name');
				if(oc[item[index]] != null){
					oc[item[index]]++;
				}else{
					oc[item[index]] = 1;
				}			
			});
			if(isNaN(input) == false && parseInt(input) > 0 && (parseInt(length) - parseInt(input)>0) ){
				var list = parseInt(length) - parseInt(input);
				var array_keys = arrayKeys(oc);			
				for(var i = 0 ; i < array_keys.length ; i++){
					for(var j = parseInt(length) ; j >=list ; j--){
						$('input[name="'+array_keys[i]+'['+j+']'+'"]').remove();
					}
				}
			}else{
				$.each(oc, function( index, value ) {
					var new_remove_id = parseInt(value)-1;
					if(new_remove_id != 0){
						$('input[name="'+index+'['+new_remove_id+']'+'"]').remove();
					}
				});
			}
		});

		$(document).on('submit', '#form-item', function(event) {		
	        var container = $('input[name="container"]').val().trim();
		    if(container == '' || isNaN(container) || container >44 || container <= 0)
		    {
		    	$('input[name="container"]').focus();
		    	alert('Container required .Between 1 - 44');
		    	return false;
		    }
		    var length = $('.text-red:first input').length;	 
		    var list = get_list_item();
		    var unlist = ['color2','color3','size2','size3'];
	    	for(var i = 0 ; i < list.length ; i++){
	    		for(var j = 0 ; j < length ; j++){
	    			var name = 'input[name="'+list[i]+"["+j+"]"+'"]';
					var values = $(name).val().trim();

					values = (values == "") ? "/" : values;
	    			if(isNaN(values) || parseInt(values) <= 0){
	    				if($.inArray(list[i], unlist) == -1){
							$(name).focus();
		    				alert(list[i] + " "+ (parseInt(j)+1)+" is required");
		    				return false;	
						}
	    			}

	    			if(list[i] == 'style_no' && values > 22 ){
	    				//console.log(values + " " + list[i] + " " + i + " 1 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 22");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'uom' && values > 55 ){
	    				//console.log(values + " " + list[i] + " " + i + " 2 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'prefix' && values > 555 ){
	    				//console.log(values + " " + list[i] + " " + i + " 3 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 555");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'suffix' && values > 55 ){
	    				//console.log(values + " " + list[i] + " " + i + " 4 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'height' &&  values > 55 ){
	    				//console.log(values + " " + list[i] + " " + i + " 5 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'width' &&  values > 11 ){
	    				//console.log(values + " " + list[i] + " " + i + " 6 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 11");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'length' &&  values > 11 ){
	    				//console.log(values + " " + list[i] + " " + i + " 7 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 11");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'weight' &&  values > 11 ){
	    				//console.log(values + " " + list[i] + " " + i + " 8 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 11");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'upc' &&  values > 5){
	    				//console.log(values + " " + list[i] + " " + i + " 9 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 5");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'size1' &&  values > 55 ){
	    				//console.log(values + " " + list[i] + " " + i + " 10 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(list[i] == 'color1' &&  values > 55 ){
	    				//console.log(values + " " + list[i] + " " + i + " 11 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
	    				$(name).focus();
	    				return false;
	    			}
	    			if(values!= "" && $.inArray(list[i], unlist) != -1){
						if(list[i] == 'size2' && values > 55){
		    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
		    				$(name).focus();
		    				return false;
		    			}
		    			if(list[i] == 'color2' && values > 55){
		    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
		    				$(name).focus();
		    				return false;
		    			}	
		    			if(list[i] == 'size3' && values > 55){
		    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
		    				$(name).focus();
		    				return false;
		    			}
		    			if(list[i] == 'color3' && values > 55){
		    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 55");
		    				$(name).focus();
		    				return false;
		    			}
					}
	    			if(list[i] == 'carton' &&  values > 10 ){
	    				//console.log(values + " " + list[i] + " " + i + " 12 " + j);
	    				alert(list[i] + " "+ (parseInt(j)+1)+" between 1 to 10");
	    				$(name).focus();
	    				return false;
	    			}
	    		}
		    }	    
		    return true;
		});	
	}
	
});
var time = document.getElementById('date');
function writeDate () {
    var today = new Date();
    /*var a = 'PM';
    if(today.getHours >12){
        a = 'AM';
    }*/
    if($('#form-item').length == 0){
    	return false;
    }
    time.value = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate()+" ";
    time.value += today.getHours() +":" + today.getMinutes() + ":" + today.getSeconds();
}

setInterval(writeDate, 1000);

function arrayKeys(input) {
    var output = new Array();
    var counter = 0;
    for (i in input) {
        output[counter++] = i;
    } 
    return output; 
}

function GetAllFormData(n) {
    var t = {}, i;
    return n.find("input[type=text], input[type=password], input[type=radio]:checked, input[type=hidden], textarea").each(function () {
        t[$(this).attr("name")] = $(this).val().trim()
    }), n.find("input[type=checkbox]").each(function () {
        t[$(this).attr("name")] = ($(this).attr("checked") == "checked" || $(this).attr("checked") == "") ? !0 : !1
    }), n.find("select").each(function () {
        t[$(this).attr("name")] = $(this).val(), t[$(this).attr("name") + "text"] = $(this).find("option:selected").text()
    }), i = {}, n.find("input[type=text], input[type=password], input[type=radio]:checked, input[type=hidden], textarea, select option:selected").each(function () {
        i = $.extend({}, i, $(this).data())
    }), $.extend({}, t, i)
}

function get_list_item(){
	var item 	= new Array;	
	var oc 		= {};	
	$('input.style-margin').each(function(index, el) {
		item[index] = $(this).attr('data-name');
		if(oc[item[index]] != null){
			oc[item[index]]++;
		}else{
			oc[item[index]] = 1;
		}			
	});
	return arrayKeys(oc);
}