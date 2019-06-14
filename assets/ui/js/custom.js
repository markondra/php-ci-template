//$.noConflict();

$(document).ready(function(){
	
	//prettyPrint();			//syntax highlighter
	mainwrapperHeight();
	responsive();
	
	
	// animation
	if($('.contentinner').hasClass('content-dashboard')) {
		var anicount = 4;	
		$('.leftmenu .nav-tabs > li').each(function(){										   
			$(this).addClass('animate'+anicount+' fadeInUp');
			anicount++;
		});
		
		$('.leftmenu .nav-tabs > li a').hover(function(){
			$(this).find('span').addClass('animate0 swing');
		},function(){
			$(this).find('span').removeClass('animate0 swing');
		});
		
		$('.logopanel').addClass('animate0 fadeInUp');
		$('.datewidget, .headerpanel').addClass('animate1 fadeInUp');
		$('.searchwidget, .breadcrumbwidget').addClass('animate2 fadeInUp'); 
		$('.plainwidget, .pagetitle').addClass('animate3 fadeInUp');
		$('.maincontent').addClass('animate4 fadeInUp');
	}
	
	// widget icons dashboard
	if($('.widgeticons').length > 0) {
		$('.widgeticons a').hover(function(){
			$(this).find('img').addClass('animate0 bounceIn');
		},function(){
			$(this).find('img').removeClass('animate0 bounceIn');
		});	
	}


	// adjust height of mainwrapper when 
	// it's below the document height
	function mainwrapperHeight() {
		var windowHeight = $(window).height();
		var mainWrapperHeight = $('.mainwrapper').height();
		var leftPanelHeight = $('.leftpanel').height();
		if(leftPanelHeight > mainWrapperHeight)
			$('.mainwrapper').css({minHeight: leftPanelHeight});	
		if($('.mainwrapper').height() < windowHeight)
			$('.mainwrapper').css({minHeight: windowHeight});
	}
	
	function responsive() {
		
		var windowWidth = $(window).width();
		
		// hiding and showing left menu
		if(!$('.showmenu').hasClass('clicked')) {
			
			if(windowWidth < 960)
				hideLeftPanel();
			else
				showLeftPanel();
		}
		
		// rearranging widget icons in dashboard
		if(windowWidth < 768) {
			if($('.widgeticons .one_third').length == 0) {
				var count = 0;
				$('.widgeticons li').each(function(){
					$(this).removeClass('one_fifth last').addClass('one_third');
					if(count == 2) {
						$(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		} else {
			if($('.widgeticons .one_firth').length == 0) {
				var count = 0;
				$('.widgeticons li').each(function(){
					$(this).removeClass('one_third last').addClass('one_fifth');
					if(count == 4) {
						$(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		}
	}
	
	// when resize window event fired
	$(window).resize(function(){
		mainwrapperHeight();
		responsive();
	});
	
	// dropdown in leftmenu
	$('.leftmenu .dropdown > a').click(function(){
		if(!$(this).next().is(':visible'))
			$(this).next().slideDown('fast');
		else
			$(this).next().slideUp('fast');	
		return false;
	});
	
	// hide left panel
	function hideLeftPanel() {
		$('.leftpanel').css({marginLeft: '-260px'}).addClass('hide');
		$('.rightpanel').css({marginLeft: 0});
		$('.mainwrapper').css({backgroundPosition: '-260px 0'});
		$('.footerleft').hide();
		$('.footerright').css({marginLeft: 0});
	}
	
	// show left panel
	function showLeftPanel() {
		$('.leftpanel').css({marginLeft: '0px'}).removeClass('hide');
		$('.rightpanel').css({marginLeft: '260px'});
		$('.mainwrapper').css({backgroundPosition: '0 0'});
		$('.footerleft').show();
		$('.footerright').css({marginLeft: '260px'});
	}
	
	// show and hide left panel
	$('.showmenu').click(function() {
		$(this).addClass('clicked');
		if($('.leftpanel').hasClass('hide'))
			showLeftPanel();
		else
			hideLeftPanel();
		return false;
	});
	
	// transform checkbox and radio box using uniform plugin
	if($().uniform)
		$('input:checkbox, input:radio, select.uniformselect').uniform();
	
	
	// show/hide widget content or widget content's child	
	if($('.showhide').length > 0 ) {
		$('.showhide').click(function(){
			var t = $(this);
			var p = t.parent();
			var target = t.attr('href');
			target = (!target)? p.next() :	p.next().find('.'+target);
			t.text((target.is(':visible'))? 'View Source' : 'Hide Source');
			(target.is(':visible'))? target.hide() : target.show(100);
			return false;
		});
	}
	
	
	// check all checkboxes in table
	if($('.checkall').length > 0) {
		$('.checkall').click(function(){
			var parentTable = $(this).parents('table');										   
			var ch = parentTable.find('tbody input[type=checkbox]');										 
			if($(this).is(':checked')) {
			
				//check all rows in table
				ch.each(function(){ 
					$(this).attr('checked',true);
					$(this).parent().addClass('checked');	//used for the custom checkbox style
					$(this).parents('tr').addClass('selected'); // to highlight row as selected
				});
							
			
			} else {
				
				//uncheck all rows in table
				ch.each(function(){ 
					$(this).attr('checked',false); 
					$(this).parent().removeClass('checked');	//used for the custom checkbox style
					$(this).parents('tr').removeClass('selected');
				});	
				
			}
		});
	}
	
	
	// delete row in a table
	if($('.deleterow').length > 0) {
		$('.deleterow').click(function(){
			var conf = confirm('Continue delete?');
			if(conf)
				$(this).parents('tr').fadeOut(function(){
					$(this).remove();
					// do some other stuff here
				});
			return false;
		});	
	}
	
	
	// dynamic table
	if($('#dyntable').length > 0) {
		$('#dyntable').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				$.uniform.update();
			}
		});
	}
	
	
	/////////////////////////////// ELEMENTS.HTML //////////////////////////////
	
	
	// tabbed widget
	$('#tabs, #tabs2').tabs();
	
	// accordion widget
	$('#accordion, #accordion2').accordion({heightStyle: "content"});
	
	
	// color picker
	if($('#colorpicker').length > 0) {
		$('#colorSelector').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector span').css('backgroundColor', '#' + hex);
				$('#colorpicker').val('#'+hex);
			}
		});
	}

	
	// date picker
	if($('#datepicker').length > 0)
		$( "#datepicker" ).datepicker();
		
	
	// growl notification
	if($('#growl').length > 0) {
		$('#growl').click(function(){
			$.jGrowl("Hello world!");
		});
	}
	
	// another growl notification
	if($('#growl2').length > 0) {
		$('#growl2').click(function(){
			var msg = "This notification will live a little longer.";
			$.jGrowl(msg, { life: 5000});
		});
	}

	// basic alert box
	if($('.alertboxbutton').length > 0) {
		$('.alertboxbutton').click(function(){
			jAlert('This is a custom alert box', 'Alert Dialog');
		});
	}
	
	// confirm box
	if($('.confirmbutton').length > 0) {
		$('.confirmbutton').click(function(){
			jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
				jAlert('Confirmed: ' + r, 'Confirmation Results');
			});
		});
	}
	
	// promptbox
	if($('.promptbutton').length > 0) {
		$('.promptbutton').click
		(function(){
			jPrompt('Type something:', 'Prefilled value', 'Prompt Dialog', function(r) {
				if( r ) alert('You entered ' + r);
			});
		});
	}
	
	// alert with html
	if($('.alerthtmlbutton').length > 0) {
		$('.alerthtmlbutton').click(function(){
			jAlert('You can use HTML, such as <strong>bold</strong>, <em>italics</em>, and <u>underline</u>!');
		});
	}
	
	// sortable list
	if($('#sortable').length > 0)
		$("#sortable").sortable();
	
	// sortable list with content-->
	if($('#sortable2').length > 0) {
		$("#sortable2").sortable();
		$('.showcnt').click(function(){
			var t = $(this);
			var det = t.parents('li').find('.details');
			if(!det.is(':visible')) {
				det.slideDown();
				t.removeClass('icon-arrow-down').addClass('icon-arrow-up');
			} else {
				det.slideUp();
				t.removeClass('icon-arrow-up').addClass('icon-arrow-down');
			}
		});
	}
	
	// tooltip sample
	if($('.tooltipsample').length > 0)
		$('.tooltipsample').tooltip({selector: "a[rel=tooltip]"});
		
	$('.popoversample').popover({selector: 'a[rel=popover]', trigger: 'hover'});
	
	
	
	///// MESSAGES /////	
	
	if($('.mailinbox').length > 0) {
		
		// star
		$('.msgstar').click(function(){
			if($(this).hasClass('starred'))
				$(this).removeClass('starred');
			else
				$(this).addClass('starred');
		});
		
		//add class selected to table row when checked
		$('.mailinbox tbody input:checkbox').click(function(){
			if($(this).is(':checked'))
				$(this).parents('tr').addClass('selected');
			else
				$(this).parents('tr').removeClass('selected');
		});
		
		// trash
		if($('.msgtrash').length > 0) {
			$('.msgtrash').click(function(){
				var c = false;
				var cn = 0;
				var o = new Array();
				$('.mailinbox input:checkbox').each(function(){
					if($(this).is(':checked')) {
						c = true;
						o[cn] = $(this);
						cn++;
					}
				});
				if(!c) {
					alert('No selected message');	
				} else {
					var msg = (o.length > 1)? 'messages' : 'message';
					if(confirm('Delete '+o.length+' '+msg+'?')) {
						for(var a=0;a<cn;a++) {
							$(o[a]).parents('tr').remove();	
						}
					}
				}
			});
		}
	}

    $('.angka').keypress(validateNumber);
    $('.angka').keyup(function(event) {
  		$(this).val(function(index, value) {
    		return value
    		.replace(/\D/g, "")
    		.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  		});
	});

	function validateNumber(event) {
		var theEvent = event || event.event;
  		var key = theEvent.keyCode || theEvent.which;
  		if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 39 || key == 46) ){
    		theEvent.returnValue = false;
    		if (theEvent.preventDefault) theEvent.preventDefault();
  		}
  	}
});