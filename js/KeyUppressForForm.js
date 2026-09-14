
	function ForInputToUppercese(elem, event){
          var posCur = doGetCaretPosition(elem);
                      if(event.keyCode==9 || event.keyCode==37 || event.keyCode==39 ||event.keyCode ==32 ){
                if(event.keyCode ==32){

                   var _val = $(elem).val();
                   if(!window.flagChackValidatePhone){
                     $(elem).val(_val.toUpperCase().replace(new RegExp(" ",'g'),""));

                       if(_val.length ==$(elem).attr("maxlength")  )
                                     setSelectionRange(elem,posCur,posCur);
                          else
                                    setSelectionRange(elem,posCur,posCur-1);
                    }else{
                           $(elem).attr("value" , _val.toUpperCase());
                             setSelectionRange(elem,posCur,posCur);
                      }
                          
                }
           }else{
              

               var _val = $(elem).val();
                if(/^[-+A-Za-z0-9*#()]+$/i.test(String.fromCharCode(event.keyCode)) ) {
                  if(!window.flagChackValidatePhone){
                                      $(elem).val(_val.toUpperCase().replace(new RegExp(" ",'g'),""));
                  }else{
                           $(elem).attr("value" , _val.toUpperCase());
                      }
                     setSelectionRange(elem,posCur,posCur);
                }

                  if ($(elem).val().length  >= $(elem).attr("maxlength")){


                    var _val = $(elem).val();
                      if(!window.flagChackValidatePhone){
                        $(elem).attr("value" , _val.toUpperCase().replace(new RegExp(" ",'g'),""))
                  
                  }else{
                           $(elem).attr("value" , _val.toUpperCase());
                      }
                     setSelectionRange(elem,posCur,posCur);
                     
                       if(posCur>=$(elem).attr("maxlength")  && $(elem).next().is('input'))

                       $(elem).next().focus();

                    }
           }



           function setSelectionRange(input, selectionStart, selectionEnd) {
                  if (input.setSelectionRange) {
                    input.focus();
                    input.setSelectionRange(selectionStart, selectionEnd);
                  }
                  else if (input.createTextRange) {
                    var range = input.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', selectionEnd);
                    range.moveStart('character', selectionStart);
                    range.select();
                  }
                }


           function doGetCaretPosition (oField) {
                            var iCaretPos = 0;
                            if (document.selection) {
                            oField.focus ();
                            var oSel = document.selection.createRange ();
                            oSel.moveStart ('character', -oField.value.length);
                            iCaretPos = oSel.text.length;
                            }
                            else if (oField.selectionStart || oField.selectionStart == '0')
                            iCaretPos = oField.selectionStart;

                            return (iCaretPos);
          }


                }


	function ForInputToUpperceseZip(elem, event) {
		var posCur = doGetCaretPosition(elem);

        var _val = $(elem).val();
		if (event.keyCode==9 || event.keyCode==37 || event.keyCode==39 ||event.keyCode ==32 ) {
			if (event.keyCode ==32) {
				$(elem).val(_val.toUpperCase().replace(new RegExp(" ",'g'),""));
				if (_val.length ==$(elem).attr("maxlength")) {
					setSelectionRange(elem,posCur,posCur);
				} else {
					setSelectionRange(elem,posCur,posCur-1);
				}
			}
		} else {
			var str = '';
			_val.split('').forEach( function(item) {
				str += item.toUpperCase().replace(new RegExp("^[^A-Za-z0-9]+$",'g'),"");
			} );
			$(elem).val(str);
		}



           function setSelectionRange(input, selectionStart, selectionEnd) {
                  if (input.setSelectionRange) {
                    input.focus();
                    input.setSelectionRange(selectionStart, selectionEnd);
                  }
                  else if (input.createTextRange) {
                    var range = input.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', selectionEnd);
                    range.moveStart('character', selectionStart);
                    range.select();
                  }
                }


           function doGetCaretPosition (oField) {
                            var iCaretPos = 0;
                            if (document.selection) {
                            oField.focus ();
                            var oSel = document.selection.createRange ();
                            oSel.moveStart ('character', -oField.value.length);
                            iCaretPos = oSel.text.length;
                            }
                            else if (oField.selectionStart || oField.selectionStart == '0')
                            iCaretPos = oField.selectionStart;

                            return (iCaretPos);
          }


     }



         function ForInputUpperceseInternal(elem, event){
                   var posCur = doGetCaretPosition(elem);
                     if(event.keyCode==9 || event.keyCode==37 || event.keyCode==39 ||event.keyCode ==32 ){

                    if(event.keyCode ==32){
                            var _val = $(elem).val();
                         $(elem).val(_val.toUpperCase().replace(new RegExp(" ",'g'),""));
                         setSelectionRange(elem,posCur,posCur-1);
                    }
               }else{


                   var _val = $(elem).val();//String.fromCharCode(event.keyCode)

                    if(/^[-+A-Za-z0-9*#()]+$/i.test(_val) ) {
                        $(elem).val(_val.toUpperCase().replace(new RegExp(" ",'g'),""));

                         setSelectionRange(elem,posCur,posCur);
                    }else{
                        $(elem).val(_val.toUpperCase().replace(new RegExp("[^-+A-Za-z0-9*#()]",'g'),""));

                         if(event.keyCode!=8 ||event.keyCode!=16 || event.keyCode!=107 ){

                            setSelectionRange(elem,posCur-1,posCur-1);
                         }

                    }
                }






               function setSelectionRange(input, selectionStart, selectionEnd) {
                      if (input.setSelectionRange) {
                        input.focus();
                        input.setSelectionRange(selectionStart, selectionEnd);
                      }
                      else if (input.createTextRange) {
                        var range = input.createTextRange();
                        range.collapse(true);
                        range.moveEnd('character', selectionEnd);
                        range.moveStart('character', selectionStart);
                        range.select();
                      }
                    }


               function doGetCaretPosition (oField) {
                                var iCaretPos = 0;
                                if (document.selection) {
                                oField.focus ();
                                var oSel = document.selection.createRange ();
                                oSel.moveStart ('character', -oField.value.length);
                                iCaretPos = oSel.text.length;
                                }
                                else if (oField.selectionStart || oField.selectionStart == '0')
                                iCaretPos = oField.selectionStart;

                                return (iCaretPos);
              }



         }