// GK MooMenu v.2.0 Copyright by GavickPro
window.addEvent("domready", function(){
	// necessary classes
		Fx.Height = Fx.Style.extend({initialize: function(el, options){$(el).setStyle('overflow', 'hidden');this.parent(el, 'height', options);},toggle: function(){var style = this.element.getStyle('height').toInt();return (style > 0) ? this.start(style, 0) : this.start(0, this.element.scrollHeight);},show: function(){return this.set(this.element.scrollHeight);}});
			
	var main = $("horiz-menu");
	var levels = new Array();
		var heightFX = new Array();		if(main){
		main.getChildren().each(function(el,i){
			levels.push(new Array());
						heightFX.push(new Array());						
			el.getElementsBySelector("ul ul").each(function(elm,j){
				levels[i].push(elm.getParent());
								heightFX[i].push(new Fx.Height(elm, {duration: 250, transition: Fx.Transitions.Quad.easeOut,wait:true}).set(0));							});
		});
		
		levels.each(function(e,k){
			e.each(function(a,l){
				a.addEvents({
					"mouseenter" : function(){
						a.getChildren()[1].setStyle("overflow","hidden");
						if(window.ie7 && (a.getChildren()[1].getParent() && a.getChildren()[1].getParent().getParent() && a.getChildren()[1].getParent().getParent().getParent() && a.getChildren()[1].getParent().getParent().getParent().hasClass("level1")) && a.getChildren()[1].getStyle("position") != 'absolute') a.getChildren()[1].setStyle("margin-top","35px");
						a.getChildren()[1].setStyle("position","absolute");
												heightFX[k][l].toggle();												(function(){a.getChildren()[1].setStyle("overflow","")}).delay(250);
					},
					"mouseleave" : function(){
						a.getChildren()[1].setStyle("overflow","hidden");
												heightFX[k][l].set(0);											}
				});
			});
		});	
	}
	// submenu activation
	$ES('li.level1 ul',main).each(function(elmt){
		if(elmt.getParent().hasClass('level1')){
			elmt.setProperty("class","level2");
			if(!(!window.ie || (document.querySelectorAll && window.ie))){
				elmt.getElementsBySelector('li ul').setStyle("display","none");
				elmt.getElementsBySelector('li').each(function(elmts){
					elmts.addEvent("mouseenter",function(){
						elmts.getElementsBySelector('ul').setStyle("display","");
					});
				});
			}
		}
	});
	
	$ES('li.level1', main).each(function(el){
		if(($E('.active',el) || el.hasClass('active')) && $E('ul', el)){
			if(!window.ie) $E('ul', el).setProperty("style","");
			else $E('ul', el).removeProperty("style");
			$E('ul', el).setStyle("display", "block");
		} 
	}); 
	
	$ES('li.level1',main).each(function(elm){
		elm.addEvent("mouseenter", function(){
			if(!window.ie) $ES('.level2', main).setProperty("style","");
			else $ES('.level2', main).removeProperty("style");
			
			if($E('ul', elm)) $E('ul', elm).setStyle("display","block");
		});
	});
});