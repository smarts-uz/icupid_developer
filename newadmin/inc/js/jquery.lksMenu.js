/* @version 1.1 lksMenu
 * @author Lucas Forchino
 * @webSite: http://www.tutorialjquery.com
 * lksMenu.
 * jQuery Plugin to create a css menu
 */
(function($){
    $.fn.lksMenu=function(){
        return this.each(function(){
            var menu= $(this);
            menu.find('ul li ul.active').slideDown('medium');
            menu.find('ul li > a').bind('click',function(event){
                var ahref = $(event.currentTarget).attr('href');
                if(ahref!='#'){
                    window.location.href = ahref;
                }else{
                    var currentlink=$(event.currentTarget);
                    if (currentlink.parent().find('ul.active').size()==1)
                    {
                        currentlink.parent().find('ul.active').slideUp('medium',function(){
                            currentlink.parent().find('ul.active').removeClass('active');
                        });
                    }
                    else if (menu.find('ul li ul.active').size()==0)
                    {
                        show(currentlink);
                    }
                    else
                    {
                        menu.find('ul li ul.active').slideUp('medium',function(){
                            menu.find('ul li ul').removeClass('active');
                            show(currentlink);
                        });
                    }
                }
            });
			menu.find('.parent-menu').bind('mouseover',function(event){
			
					var currentlink=$(event.currentTarget);
					
                    /*        menu.find('.parent-menu ul').removeClass('active');
					menu.find('ul li ul.active').slideUp('medium',function(){
                            menu.find('.parent-menu ul').removeClass('active');
                    });*/
					
					
					show(currentlink);
				
                
            });
			menu.find('.menu ul li ul').bind('mouseout',function(event){ 
					
                
                    var currentlink=$(event.currentTarget);
                    
                        currentlink.parent().find('ul.active').slideUp('medium',function(){
                            currentlink.parent().find('ul.active').removeClass('active');
                        });
					 
                    
                    
              });
            function show(currentlink){
                currentlink.parent().find('ul').addClass('active');
                currentlink.parent().find('ul').slideDown('medium');
            }
        });
    }
})(jQuery);