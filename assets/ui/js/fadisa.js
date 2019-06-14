$(document).ready(function(){
	$('.angka').keypress(validateNumber);
    $('.angka').keyup(function(event) {
  		$(this).val(function(index, value) {
    		return value
    		.replace(/\D/g, "")
    		.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  		});
	});
	$('.ed').datepicker({        
		dateFormat: "yy-mm-dd",
		showAnim:"slide",
		changeMonth: true,
		changeYear: true
	});
	$('.tgl').datepicker({        
		dateFormat: "dd-mm-yy",
		showAnim:"slide",
		changeMonth: true,
		changeYear: true
	});
	$('.bln').MonthPicker();
});

function showAlert(type,dismis = '',text){
	html = "<div class='alert alert-"+type+" "+dismis+"'>";
	html += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	html += text;
	html += "</div>";
	return html;
}

function validateNumber(event) {
	var theEvent = event || event.event;
	var key = theEvent.keyCode || theEvent.which;
	if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 39 || key == 46) ){
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
}

function ribuan(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

function tglIndo(sTgl){
	var tgl = sTgl.split('-');
	return tgl[2]+'-'+tgl[1]+'-'+tgl[0];
}

var bulan = {'01':'Januari', '02':'Februari', '03':'Maret', '04':'April', '05':'Mei', '06':'Juni', '07':'Juli', '08':'Agustus', '09':'September', '10':'Oktober', '11':'November', '12':'Desember'};
var bln = {'01':'Jan', '02':'Feb', '03':'Mar', '04':'Apr', '05':'Mei', '06':'Jun', '07':'Jul', '08':'Ags', '09':'Sep', '10':'Okt', '11':'Nov', '12':'Des'};
function edIndo(sTgl){
	var tgl = sTgl.split('-');
	return tgl[1]+'-'+tgl[0];
}

function tglSQL(sTgl){
	var tgl = sTgl.split('-');
	return tgl[2]+'-'+tgl[1]+'-'+tgl[0];
}

function convertToNumber(str){
	var num = str.replace(/\./g, '');
	return num;
}