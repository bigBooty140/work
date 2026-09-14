 (function($){
	$.fn.selectchain = function(options){
		var defaults = {
			ajaxActiveAbort: false,  
			url: '',
			prepend: {'':'All'},
			append: {},
			target: '',
			targets: [],
			selected: null,
			data: (this[0])?{selectchain:this[0].id}:{},
			sources: [],
			onReload: function(){}
		};

		var settings = $.extend({}, defaults, options);
		if (settings.target) if (!(settings.target instanceof $)) settings.target = $(settings.target);
		if (!settings.targets.length)
		{
			if (settings.target)
				settings.targets.push(settings.target);
		}
		for (i = 0; i < settings.targets.length;i++)
		{
			if (!(settings.targets[i] instanceof $)) settings.targets[i] = $(settings.targets[i]);
			if (settings.targets[i] == $(this)) settings.targets.splice(i,1);
		}
		for (i = 0; i < settings.sources.length;i++)
		{
			if (settings.sources[i]) if (!(settings.sources[i] instanceof $)) settings.sources[i] = $(settings.sources[i]);
		}
		
		var selectChain = $.data(this[0], 'selectChain');
		if (selectChain)
		{
			return selectChain;
		}
		
		selectChain = new $.selectChain(settings,this[0]);
		//_selectChain = ;
		if (settings.targets.length)
		{
			$(this).change(function(){
				for (i in settings.targets)
				{
					if ($(this).data('notChange'))
					//if (selectChain.notChange)
					{
						settings.targets[i].selectchain().setSelected();
					}
					$(this).data('notChange',false);
					//selectChain.notChange = false;
                                        
                                        // If the value specified "true", then when you select all active 
                                        // ajax requests in the chain will be interrupted
                                        // (according to the data specified in the option "targets" to 
                                        // view all related items)
                                        if (settings.ajaxActiveAbort) {
                                            
                                            var chainRecursAllow = 15;  // the maximum depth of recursion
                                            var chainRecursCur = 0;
                                            var chainTargets = [];
                                            // A recursive function is compiling a list of related objects
                                            var getChainTargets = function (curTarget) {
                                                chainRecursCur++;
                                                chainTargets.push(curTarget);
                                                if (chainRecursCur < chainRecursAllow) {
                                                    var objTargetsData = curTarget.data('selectChain');
                                                    var objTargets = (objTargetsData) ? objTargetsData.options.targets : [];
                                                    for (var t in objTargets) {
                                                        getChainTargets(objTargets[t]);
                                                    }
                                                }
                                                return true;
                                            };
                                            
                                            getChainTargets(settings.targets[i]);
                                            // Kill the active requests related objects
                                            for (var t in chainTargets) {
                                                var ajaxLink;
                                                ajaxLink = chainTargets[t].find('option:first').data('ajaxLinkSelectChain');
                                                if (ajaxLink && (typeof ajaxLink.abort === 'function')) {
                                                    ajaxLink.abort();
                                                }
                                            }
                                        }
					settings.targets[i].selectchain().reload();
				}
			});
		}
		$.data(this[0], 'selectChain', selectChain); 
		return selectChain;
	};
	$.selectChain = function(options, select)
	{
		this.options = options;
		this.select = select;
		this.setSelected = function(sel)
		{
			if (sel)
			{
				this.options.selected = sel;
			}
			else
			{
				this.options.selected = $(this.select).val();
				this.notChange = true;
			}
			return this;
		}
		this.reload = function(){
			var url = this.options.url;
			var obj = $(this.select);
			var options = this.options;
			var selected = options.selected;
			var sources = {};
			for (var i = 0; i < this.options.sources.length;i++)
			{
				if (this.options.sources[i])
				{
					id = this.options.sources[i].attr('id');
					val = this.options.sources[i].val();
					sources[id] = val;
				}
			}
			var data = $.extend(this.options.data,sources);
                        
                        // If a query on the active object, interrupt
			if (options.ajaxActiveAbort) {
                            var ajaxLink = obj.find('option:first').data('ajaxLinkSelectChain');
                            if (ajaxLink && (typeof ajaxLink.abort === 'function')) {
                                //jalert('abort');
                                ajaxLink.abort();
                            }
			}
			
			obj.empty();
			obj.attr('disabled','disabled');
			obj.append('<option>Loading...</option>');
                        
			var ajaxLink = $.ajax({
				url: url,
				data: data,
				type: 'POST',
				dataType: 'json',
				success: function (resp) {
					obj.empty();
					obj.removeAttr('disabled');
					for (i in options.prepend)
					{
						obj.prepend("<option value='"+i+"'>"+options.prepend[i]+"</option>");
					}
					var j = __toArray(resp); 
                                        //jalert(j.join('-'));
                                       
                                        var html = '';
                                                                                
					for (i=0;i<j.length;i++) {
                                                if (! j[i]){ continue; }
						var o = "<option value='"+j[i][0]+"'";
                                                
                                                
                                                if (options.selected !== null){
                                                    
							if (options.selected == j[i][0])
							{
								//o.attr('selected', 'selected');
                                                                o += " selected='selected' ";
								options.selected = null;
							}
                                                }
						//obj.append(o);
                                                 o += ">"+j[i][1]+"</option>"
                                                 html += o;
					}
                                        //jalert(html);
					obj.append(html);
					for (i in options.append)
					{
						obj.append("<option value='"+i+"'>"+options.append[i]+"</option>");
					}
					if (options.onReload) options.onReload(j);
					// hand control back to browser for a moment
					setTimeout(function () {
						obj.trigger('change');
					}, 0);
				},
				error: function (xhr, desc, er) {
                                    //alert("an error occurred");
                                    
                                    // If the request is interrupted restores value default
                                    if (options.ajaxActiveAbort && (desc === 'abort')) {
                                        obj.empty();
                                        obj.removeAttr('disabled');
                                        for (i in options.prepend) {
                                            obj.prepend("<option value='"+i+"'>"+options.prepend[i]+"</option>");
                                        }
                                    }
				}
			});
                        
                        // memorize link to request
			if (options.ajaxActiveAbort) {
				obj.find('option:first').data('ajaxLinkSelectChain', ajaxLink);
			}
		};
		return this;
	};
})(jQuery);

function __toArray( obj ) {
  var arr = [];
  var k=0;

  var arraElem =new Array();
  for (var i in obj){
    if(i!=""){
        arr[k] = [i,obj[i]];
    }else{
      arraElem.push([i,obj[i]]);
    }
    k++;

  }

var rez =arr.sort(function(a,b){

      var a1 = (""+a[1]).toLowerCase();
      var b1 = (""+b[1]).toLowerCase();
     
        if(a1 > b1) return 1;
        if(a1 < b1) return -1;
     
      return 0;
  });
 
  return rez.concat(arraElem);
  
}
