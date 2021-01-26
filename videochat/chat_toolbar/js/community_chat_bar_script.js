/**
 * Copyright � 2004-2013 Chat software by www.flashcoms.com
 */

//Chat-widget settings
var appSettings = {

	emotions: {
		':)': '01',
		':D': '02',
		';)': '03',
		':0': '04',
		':(': '05',
		':\\': '06',
		':|': '07',
		'0:)': '08',
		':p': '09',
		':`0': '10',
		':8': '11',
		':[': '12',
		':S': '13',
		':E': '14',
		':b': '15'
	},
	emotionsPath: "chat-widget/img/emotions",

	maxHistoryMessages: 100
};

//replace "mobile-client" with "chat-widget" to see chat widget instead of mobile-client
//but mobile-client is not compatible with IE
var toolBarTemplate =      "<a class='slider'><img alt='' id='bot' src='chat_toolbar/images/arrow_bottom.png'></a>"
                           + "<div id='chat-container' class='chatContainer'></div>"
                           + "<ul id='chatBarNav'>"
                           +     "<li>"
                           +         "<a href='#' id='chat-widget' class='sub' style='width:111px;'><img src='chat_toolbar/images/logo.png' />Widget</a>"
                           +     "</li>"
                           +     "<li class='chat-chatBarNav-last'>"
                           +         "<ul>"
                           +             "<li><a href='javascript:z5chat.OpenPopup();'><img src='chat_toolbar/images/send.png' />Popup</a></li>"
                           +             "<li><a href='javascript:z5chat.OpenFullscreen();'><img src='chat_toolbar/images/send.png' />Fullscreen</a></li>"
                           +             "<li><a href=\"javascript:window.location='chat_embedded.php'\"><img src='chat_toolbar/images/send.png' />Embeded</a></li>"
                           +         "</ul>"
                           +         "<a href='#' class='sub' style='width:110px;'><img src='chat_toolbar/images/logo.png' />Chat</a>"
                           +     "</li>"
                           + "</ul>";

$(function(){
    //Community chat toolbar container
    var cont = document.createElement('div');
    cont.id = 'community_chat_toobar';
    cont.className = 'chatBarMenuContent';
    cont.innerHTML = toolBarTemplate;
    document.body.appendChild(cont);
});

var z5ChatToolbar = new Z5ChatToolbar();

function Z5ChatToolbar(){
    //for mobile-client only
    this.uid = '';
    this.mobileClientUrl = 'http://chat71/mobile-client/index.htm';

    //for chat widget only
    this.host = 'http://localhost:8888'; // for mobile-client it is represented in ...mobile-client/index.htm
    this.roomID = '';
    this.onJoinLink = function() {z5chat.OpenPopup();};



    this.ShowToolBar = function()
    {
        var self = this;
        $('.slider').live('click', function () {
            $('#chatBarNav').slideToggle(300);

            var img = $(this).find('img');
            if ($(img).attr('id') == 'bot') {
                $(img).attr('src', 'chat_toolbar/images/arrow_top.png');
                $(img).attr('id', 'top');
            } else {
                $(img).attr('src', 'chat_toolbar/images/arrow_bottom.png');
                $(img).attr('id', 'bot');
            }
        });

        $('.sub').live('click', function () {
            var cur = $(this).prev();
            $(cur).slideToggle(300);
        });

        $('#chat-widget').live('click', function () {
            var container = $('#chat-container');

            if (container.children().length > 0) {
                container.flashcomsChat('remove');
                $(container).attr('style', ''); //for IE compatibility
            } else {
                container.flashcomsChat({
                    host: self.host,
                    roomID: self.roomID,
                    onJoinLink: self.onJoinLink
                });

                container.width($('#chatBarNav').width()-2);
            }
        });


        $('#mobile-client').live('click', function () {
            var container = $('#chat-container');

            if (container.children().length > 0)
            {
                $('#mobile_client_iframe').toggle();
            } else {
                var iframe = document.createElement('iframe');

                iframe.setAttribute("id", "mobile_client_iframe");
                iframe.setAttribute("class", "mobileClient");
                iframe.setAttribute("frameBorder", "0");
                iframe.setAttribute("scrolling", "auto");
                iframe.setAttribute("src", self.mobileClientUrl + "?uid=" + self.uid);

                container.append(iframe);
            }
        });
    }
}

