<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Community Chat 7.1</title>

	<script type="text/javascript" src="./js/flashcoms.js"></script>
	<script type="text/javascript">

		function AIRNavigateTo(url)
		{
			try
			{
				// defined in air client
				CGOpen(url);
			}
			catch(e)
			{
				// do nothing
			}
		}

        function AIRMessageNotify(url)
        {
            try
            {
                // defined in air client
                CGNotify();
            }
            catch(e)
            {
                // do nothing
            }
        }



		function Z5Close() { self.close(); }

		z5chat.uid = '<?php echo $_GET['uid'];?>';
		//z5chat.roomID = 'room2';
        //z5chat.roomPassword = 'password';
        //z5chat.logoURL = 'http://youdomain/logo.png';
		//z5chat.preloaderBgColor = 0xff0000;
		//z5chat.bgColor = 0x0000ff;
		z5chat.ShowChat();

	</script>

</head>
<body style="margin:0px; padding:0px;">

</body>
</html>
