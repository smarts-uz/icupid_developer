<?php

$admin_charset = '';

ini_set('default_charset', 'iso-8859-1');

$LANG_ = array(
"_language" => "Svenska",
"_charset" => "iso-8859-1", 
);
$GLOBALS['_META'] = $LANG_;	

// ADMIN AREA
$admin_layout_header = array(

	"charset" => "iso-8859-1",
	"title" => "Administrationsomr�de"
		
);

$admin_layout = array(

	"3" => "Mina preferenser",
	"4" => "Logga ut",

);


$admin_layout_page1 = array(

	"" => "Instrumentbr�da",

		"_*" => "Administrationsomr�de instrumentbr�da",
		"_?" => "",

	"members" => "Medlemsstatistik",
		
		"members_*" => "Medlemsstatistik",
		"members_?" => "Grafen nedan visar siffrorna �ver nya medlemmar som registrerat sig under de senaste tv� veckorna.",
		"members_^" => "sub",

	"affiliate" => "Affiliatestatistik",
 
		"affiliate_*" => "Affiliatestatistik",
		"affiliate_?" => "Grafen nedan visar siffrorna �ver nya affiliates som registrerat sig under de senaste tv� veckorna.",
		"affiliate_^" => "sub",

	"visitor" => "Bes�karstatistik",
 
		"visitor_*" => "Bes�karstatistik",
		"visitor_?" => "Grafen nedan visar siffrorna �ver bes�karstatistik p� webbsajten som sparats av mjukvaran varje dag under de senaste tv� veckorna.",
		"visitor_^" => "sub",

	"maps" => "Googlekartor",
 
		"maps_*" => "Bes�kares bel�genhet med Googlekartor",
		"maps_?" => "Denna avdelning till�ter dig att se varifr�n i v�rlden dina medlemmar bes�ker din webbsajt. Detta till�ter dig att utveckla din marknadsf�ring och annonseringskampanjer mer effektivt genom att rikta in dig p� olika l�nder.",
 

	"adminmsg" => "Tillk�nnagivanden p� webbsajten",
 
		"adminmsg_*" => "Meddelanden p� webbsajten",
		"adminmsg_?" => "Skriv in ditt meddelande i rutan nedanf�r och varje g�ng en medlem loggar in p� sitt konto kommer meddelandet att visas f�r dem. Detta �r perfekt f�r att visa tillk�nnagivanden om en service eller �ndringar p� webbsajten.",

);
 

$admin_layout_page01 = array(

	"backup" => "DB Backup",
 
		"backup_*" => "databas Backup",
		"backup_?" => "V�lj ett eller flera av tabellerna nedan f�r att s�kerhetskopiera din databas. Det rekommenderas starkt att du anv�nder v�rd omr�de databas funktioner f�r s�kerhetskopiering f�r att s�kerst�lla att all data tas emot.",
	
	"license" => "Licensnyckel",
 
		"license_*" => "Licensnyckel",
		"license_?" => "Nedan listas seriella licensnycklar , ta n�r du redigerar dessa s� att de �r korrekta. Du hittar dem p� AdvanDate.com i ditt Mitt konto omr�de."
);

$admin_layout_page2 = array(

	"" => "Medlemmar",

		"_$" => "halv",
		"_*" => "Administrera medlemmar",
 

			"edit" => "Redigera medlemsuppgifter",
	
				"edit_*" => "Redigera medlem",
				"edit_?" => "Anv�nd valm�jligheterna nedanf�r f�r att uppdatera medlemskonto och profiluppgifter.",
				"edit_^" => "ingen",


			"fake" => "Fejkmedlemmar",
	 
				"fake_*" => "Generera fejkmedlemmar",
				"fake_?" => "Anv�nd valm�jligheterna nedan f�r att generera fejkmedlemmar till din webbsajt, detta f�r din webbsajt att se 'v�lbes�kt' ut medan du kommer ig�ng. Det rekommenderas att du anv�nder samma epostadress f�r alla fejkmedlemmar ifall du skulle vilja lokalisera och ta bort dem vid senare tillf�lle.",
				"fake_^" => "sub",

	"banned" => "F�rbjudna medlemmar",
 
		"banned_*" => "F�rbjudna medlemmar",
		"banned_?" => "Mjukvaran har ett inbyggt hackers uppt�ckarsystem som automatiskt blockerar medlemmar som f�rs�ker hacka din webbsajt. Nedan finns alla de nuvarande medlems- (och icke medlem) uppgifterna f�r hackningsf�rs�k.",
		"banned_^" => "sub",

	"monitor" => "�vervaka medlemmar",
 
		"monitor_*" => "�vervaka medlemmar",
		"monitor_?" => "D� och d� kan medlemmar rapportera andra medlemmar f�r att missbruka meddelandesystemet eller f�r att skicka otrevliga eller o�nskade medlemmar. Du kan anv�nda detta verktyg f�r att se och �vervaka medlemsmeddelanden f�r att hj�lpa till att skydda andras s�kerhet.",
		"monitor_^" => "sub",

	"import" => "Importera medlemmar",
 
		"import_*" => "Importera medlemmar fr�n databas eller CVS fil",
		"import_?" => "Genom att anv�nda valm�jligheterna nedanf�r kan du importera medlemmar till din webbsajt fr�n annan dating/community mjukvaruplattform eller fr�n en CVS backup.",
		"import_^" => "sub",
		
	"files" => "Medlemsfiler", 
	"files_*" => "Medlemmarnas albumfiler",


	"addfile" => "Ladda upp foto",			 
	"addfile_*" => "Ladda upp ett foto",
	"addfile_?" => "Ibland kommer en medlem att ha sv�rt att ladda upp ett foto till sin webbsajt. Genom att anv�nda denna avdelning kan du ladda upp ett foto �t din medlem.",
	"addfile_^" => "sub",
			
 
	"affiliate" => "Webbsajtsaffiliates",
 
		"affiliate_*" => "Webbsajtsaffiliates",
		"affiliate_?" => "Genom att anv�nda valm�jligheterna nedanf�r kan du sk�ta dina webbsajtsaffiliates.",
		 
			"addaff" => "L�gg till ny affiliate",
	 
				"addaff_*" => "L�gg till/Redigera affiliatekonto",
				"addaff_?" => "Fyll i alla f�lten nedanf�r f�r att l�gga till/redigera ett affiliatekonto p� din webbsajt.",
				"addaff_^" => "sub",

			"affsettings" => "Affiliate inneh�llssidor",
 
				"affsettings_*" => "Affiliate sidodesign",
				"affsettings_?" => "Anv�nd valm�jligheterna nedanf�r f�r att redigera ordvalet p� dina affiliatesidor.",
				"affsettings_^" => "sub",

			"affcom" => "Affiliateprovision",
	 
				"affcom_*" => "Affiliateprovision",
				"affcom_?" => "H�r kan du ange provisionsniv�n f�r dina affiliates. Detta inneb�r att f�r varje f�rs�ljning som gjorts av en medlem som skickats till din webbsajt av en affiliate , kommer de att generera procent av den totala summan nedanf�r.",
				"affcom_^" => "sub",


			"affban" => "Affiliatebanners",
	 
				"affban_*" => "Affiliatebanners",
				"affban_?" => "H�r kan du g�ra i ordning bannerannonserna som kommer att visas inom affiliatekontot f�r dina affiliates att anv�nda p� deras webbsajter.",
				"affban_^" => "sub",

);

$admin_layout_page02 = array(


	"adminmsg" => "site Meddelande",
 
		"adminmsg_*" => "site Meddelande",
		"adminmsg_?" => "Ange ditt meddelande i rutan nedan och varje g�ng en medlem loggar in p� sitt konto meddelandet kommer att visas f�r dem. Detta �r bra f�r att visa servicemeddelanden eller webbplats�ndringar.",

);
$admin_layout_page3 = array(

 

		"" => "Temagalleri",
 
			"_*" => "Temagalleri",
			"_?" => "Listade nedanf�r finns alla webbsajtsschabloner som f�r tillf�llet finns installerade p� din webbsajt. Klicka p� f�rhandstitta p� bild f�r att direkt �ndra schablonen p� din webbsajt.",
			 
				
			"color" => "F�rgscheman",
		 
				"color_*" => "F�rgscheman",
				"color_?" => "Genom att anv�nda valm�jligheterna nedanf�r kan du anpassa f�rgschemat f�r din webbsajt. Om du vill ers�tta bilder med dina egna, v�nligen anv�nd bildverktyget f�r temat.",
				"color_^" => "sub",
				
			"logo" => "Webbsajtslogo",
				"logo_$" => "halv",
				"logo_*" => "Webbsajtslogo",
				"logo_?" => "Anv�nd valm�jligheterna p� denna sida f�r att anpassa logoutseendet p� din webbsajt. Du kan v�lja en f�rdesignad logo eller ladda upp din egen.",
				"logo_^" => "sub",
				
			"img" => "Temabilder",
				"img_$" => "halv",
				"img_*" => "Temabilder",
				"img_?" => "Bilderna nedanf�r �r alla lagrade i din schablon bildmapp. Anv�nd valm�jligheterna nedanf�r f�r att ers�tta existerande bilder med nya som du v�ljer.",
				"img_^" => "sub",

			"text" => "Hemsidestext",
				"text_$" => "halv",
				"text_*" => "Hemsidestext",
				"text_?" => "F�lten nedan till�ter dig att �ndra v�lkomsttexten p� din webbsajts hemsida. Vissa schabloner anv�nder olika upps�ttningar av ordval s� du kan beh�va experimentera f�r att komma fram till vilket som �r det r�tta f�r dig.",
				"text_^" => "sub",


			"terms" => "Villkor f�r webbsajt",
				"terms_$" => "halv",
				"terms_*" => "Villkor f�r webbsajt",
				"terms_?" => "Redigera f�ltet nedanf�r f�r att anpassa villkoren f�r din webbsajt. Dessa visas sedan p� registreringssidan under registreringen.",
				"terms_^" => "sub",
	
			"edit" => "Sidor & Filer",
 
			"edit_*" => "Webbsajtssidor",
			"edit_?" => "V�lj fr�n listrutorna nedanf�r f�r att se inneh�llet i filerna p� din webbsajt. Det rekommenderas att man kopierar och klistrar in koden i en editor som frontpage eller dreamweaver innan redigering och klistrar tillbaka det n�r du �r f�rdig. <b>V�nligen var noga n�r du redigerar config eller systemfiler eftersom �ndringar �r omedelbara och inte kan backas.</a>",
				
	
	
				"newpage" => "Skapa sida",
				"newpage_$" => "halv",
				"newpage_*" => "Skapa en ny sida",
				"newpage_?" => "Att skapa en ny sida p� din webbsajt �r enkelt. Skriv in en ordtitel i rutan nedanf�r och din sida kommer att skapas redo att redigeras.",
				"newpage_^" => "sub",
							
				
			"meta" => "Metataggar f�r tema",
				"meta_$" => "halv",
				"meta_*" => "Editor f�r metataggar",
				"meta_?" => "eMeeting har ett sofistikerat skapelsesystem f�r metataggar inbyggt i mjukvaran som hj�lper dig att spara tid och pengar n�r du inte beh�ver skapa tusentals sidobeskrivningar p� egen hand. Mjukvaran kommer automatiskt att generera titel, beskrivning och nyckelord f�r metataggar baserade p� inneh�llet som visas p� sidan.",
				"meta_^" => "sub",

 

		
			"menu" => "Menyrad",
				"menu_$" => "halv",
				"menu_*" => "Menyradshantering",
				"menu_?" => "Anv�nd valm�jligheterna nedanf�r f�r att �ndra ordningen p� dina medlemmars rader eller l�gga till nytt menyinneh�ll. Du kan ocks� skriva in externa l�nkar s� som http://google.com som menyl�nk f�r ett menyval om du �nskar l�nka till en annan webbsajt eller sida p� din webbsajt.",
				"menu_^" => "sub",

	"manager" => "Filhanterare",
		"manager_$" => "halv",
		"manager_*" => "Filhanterare",
		"manager_?" => "Filhanteraren �r v�ldigt anv�ndbar n�r man ska l�gga till eller ta bort nya filer/inneh�ll till din webbsajt. Du kan s�ka genom hela v�rdkontot och ta bort filer om det beh�vs.",

			"slider" => "Roterande bilder",
				"slider_$" => "halv",
				"slider_*" => "Roterande bilder p� hemsida",
				"slider_?" => "Sliderbilderna �r de roterande bilderna som visas p� din hemsida. Anv�nd valm�jligheterna nedanf�r f�r att �ndra bilden, beskrivningen och klickbara l�nkar.",
				"slider_^" => "sub",

	"languages" => "Spr�kfiler",
		"languages_$" => "halv",
		"languages_*" => "Spr�kfiler",
		"languages_?" => "Listade nedan finns alla spr�kfiler som finns laddade till din webbsajt. Du kan ta bort vilken som helst av spr�kfilerna som du inte vill anv�nda och de kommer inte att visas p� din webbsajt eller markera rutan f�r att �ndra standardspr�k f�r webbsajten. <b>L�gg m�rke till att du m�ste logga ut fr�n admin och webbsajten f�r att se eventuella spr�k�ndringar</b>",

			"editlanguage" => "Redigera spr�kfiler",
				"editlanguage_$" => "halv",
				"editlanguage_*" => "Redigera spr�kfiler",
				"editlanguage_?" => "Var f�rsiktig n�r du redigerar spr�kfilen nedan, se till att beh�lla samma syntax f�r att f�rhindra systemfel. Skriv bara in inneh�llet inom efter pilen (=>) Det f�rsta v�rdet anv�nds som nyckel.",
				"editlanguage_^" => "sub",

			"addlanguage" => "L�gg till spr�kfil",
				"addlanguage_$" => "halv",
				"addlanguage_*" => "L�gg till spr�kfil",
				"addlanguage_?" => "Att skapa en ny spr�kfil kommer helt enkelt att kopiera en av de existerande som du v�ljer nedan och d�pa om den, du kan sedan �ppna upp spr�kfilen och redigera inneh�llet.",
				"addlanguage_^" => "sub",



);


$admin_layout_page4 = array(

	"" => "Epost och nyhetsbrev",

		"_$" => "halv",
		"_*" => "Epost och nyhetsbrev",
		"_?" => "Nedan finns listan �ver alla epostadresser som f�r tillf�llet finns lagrade i systemet. System epost anv�nds av mjukvaran f�r att skicka epostmeddelande till medlemmarna vid h�ndelser s� som registrering eller vid f�rlorat l�senord. Du kan anpassa all epost och skapa din egen genom att anv�nda valm�jligheterna nedan",

			"add" => "Skapa nytt epostmeddelande",
				"add_$" => "halv",
				"add_*" => "L�gg till/Redigera nytt epostmeddelande",
				"add_?" => "Fyll i formul�ren nedanf�r f�r att l�gga till/redigera ditt nya epostmeddelande, detta kommer d� att sparas i din mapp f�r epostmallar s� att du kan �terv�nda till det eller skicka det n�r du vill.",
				"add_^" => "sub",

	"welcome" => "V�lkomstepost",
		"welcome_$" => "halv",
		"welcome_*" => "Ordna v�lkomstepost",
		"welcome_?" => "Genom att anv�nda valm�jligheterna nedan kan du v�lja vilket epostmeddelande och textmeddelande som ska skickas till medlemmen vid registrering.",
		"welcome_^" => "sub",

	"template" => "Epostmallar",
		"template_$" => "halv",
		"template_*" => "Epostmallar",
		"template_?" => "Listade nedan finns ett urval av mallar som �r inbyggda i mjukvaran. Klicka p� n�gon av bilderna f�r att �ppna och redigera mallen.",
		"template_^" => "sub",

	"export" => "Ladda ner epost",

		"export_$" => "halv",
		"export_*" => "Ladda ner epost",
		"export_?" => "Anv�nd valm�jligheterna nedan f�r att ladda ner alla medlemmars epostadresser fr�n databasen.",
		"export_^" => "sub",

	"sendnew" => "Skicka nyhetsbrev",

		"sendnew_$" => "halv",
		"sendnew_*" => "Skicka nyhetsbrev",
		"sendnew_?" => "Anv�nd den h�r avdelningen f�r att b�rja skicka nyhetsbrev till dina medlemmar. V�lj f�rst vilka medlemmar det ska skickas till och v�lj sedan vilket epostmeddelande som ska skickas.",

	"send" => "Skicka enskilt epostmeddelande",

		"send_$" => "halv",
		"send_*" => "Skicka enskilt epostmeddelande",
		"send_?" => "Anv�nd denna valm�jlighet f�r att skicka ett enskilt epostmeddelande till en medlem genom att skriva in epostadressen nedan. Eposten som anv�nds f�r att skicka brevet �r samma som som finns listad p� ditt adminkonto.",
		"send_^" => "sub",

	"subs" => "Epostp�minnelse",

		"subs_$" => "halv",
		"subs_*" => "Epostp�minnelse",
		"subs_?" => "Epostp�minnelse till�ter dig att skicka epostmeddelanden till medlemmar som befinner sig X antal dagar fr�n en h�ndelse som att deras medlemskap h�ller p� att g� ut eller att de inte har ett foto inlagt.",
		"subs_^" => "sub",
		
	"tc" => "Epostrapporter",
		"tc_$" => "halv",
		"tc_*" => "Epostrapporter",
		"tc_?" => "Epostrapporter genereras n�r ett epostmeddelande skickas som inneh�ller sp�rningskoden. De genererar statistik �ver hur m�nga medlemmar som �ppnat det epostmeddelande som du skickat.",
		"tc_^" => "sub",

			"tracking" => "Sp�rningskod f�r epost",
				"tracking_$" => "halv",
				"tracking_*" => "Sp�rningskod f�r epost",
				"tracking_?" => "Sp�rningskoden nedan (sp�rnings_id) ers�tts med en transparent bild som bifogas till epostmeddelandet n�r det skickas. Om meddelandet �ppnas och bilden inte blockeras kan systemet se att meddelandet har �ppnats och genererar d�rmed en sp�rningsrapport till dig.",
				"tracking_^" => "sub",



	"SMSsend" => "Skicka SMS-meddelanden",

		"SMSsend_$" => "halv",
		"SMSsend_*" => "Skicka SMS-meddelanden",
		"SMSsend_?" => "Anv�nd valm�jligheterna nedanf�r f�r att skicka SMS/textmeddelanden till dina medlemmars mobiltelefoner.",
);

$admin_layout_page5 = array(

	"" => "Medlemskapsniv�er",

		"_$" => "halv",
		"_*" => "Medlemskapsniv�er",
		"_?" => "Listade nedan finns alla nuvarande medlemskapspaket som finns p� din webbsajt. De som �r belysta med gr�nt kr�vs av systemet f�r att kontrollera hur bes�kare och nya medlemmar hanteras vilket ger dig mer kontroll �ver din webbsajt.",

			"epackage" => "L�gg till paket",
				"epackage_$" => "halv",
				"epackage_*" => "L�gg till/Redigera paket",
				"epackage_?" => "Fyll i formul�ren nedan f�r att l�gga till eller uppdatera medlemskapspaketen f�r din webbsajt.",
				"epackage_^" => "sub",

			"packaccess" => "Hantera tillg�ng",
				"packaccess_$" => "full",
				"packaccess_*" => "Hantera sidotillg�ng",
				"packaccess_?" => "H�r kan du kontrollera tillg�ng till hela din webbsajt baserat p� medlemskapspaket. <b>Notera: Klicka bara i rutan om du INTE vill att medlemmen ska se den sidan. </b>",
				"packaccess_^" => "sub",

			"upall" => "Flytta �ver medlemmar",
				"upall_$" => "halv",
				"upall_*" => "Flytta �ver medlemmar mellan paket",
				"upall_?" => "Andv�nd den h�r valm�jligheten om du vill flytta en medlem fr�n ett medlemskapsniv� till en annan.",
								"upall_^" => "sub",


	"gateway" => "Betalningsportar",

		"gateway_$" => "halv",
		"gateway_*" => "Betalningsportar",
		"gateway_?" => "Betalningsportar till�ter dig att ta betalt f�r medlemskapsuppgraderingar. Om du driver en kostnadsfri webbsajt kan du st�nga av betalningssystemet i inst�llningsfunktionen.",


			"addgateway" => "L�gg till betalningsport",
				"addgateway_$" => "halv",
				"addgateway_*" => "L�gg till betalningsport",
				"addgateway_?" => "Mjukvaran har ett antal betalningsportar som redan �r inbyggda i systemet, v�lj leverant�r fr�n listan nedan f�r att anv�nda denna p� din webbsajt.",
				"addgateway_^" => "sub",


	"billing" => "Faktureringssystem",

		"billing_$" => "halv",
		"billing_*" => "Faktureringssystem",	


		"affbilling" => "Faktureringshistorik f�r affiliate",
	
			"affbilling_$" => "halv",
			"affbilling_*" => "Faktureringshistorik f�r affiliate", 
			"affbilling_^" => "sub",


);

$admin_layout_page6 = array(

	"" => "Banners och annonsering",

		"_$" => "halv",
		"_*" => "Banners och annonsering",
 

			"addbanner" => "L�gg till banner",
				"addbanner_$" => "halv",
				"addbanner_*" => "L�gg till banner",
				"addbanner_?" => "Anv�nd valm�jligheterna nedan f�r att l�gga till en ny banner till din webbsajt.",
				"addbanner_^" => "sub",


);

$admin_layout_page7 = array(

	"" => "Visningsinst�llningar",

		"_$" => "halv",
		"_*" => "Visningsinst�llningar",
		"_?" => "Anv�nd valm�jligheterna nedan f�r att s�tta p�/st�nga av webbsajtsfunktioner som du inte vill anv�nda.",


	"op" => "Visa valm�jligheter",

		"op_$" => "halv",
		"op_*" => "Visa valm�jligheter",
		"op_?" => "Anv�nd valm�jligheterna nedan f�r att anpassa inst�llningarna p� din webbsajt som du vill ha dem.",
	
		"op1" => "S�k inst�llningar",
	
			"op1_$" => "halv",
			"op1_*" => "S�k visningsinst�llningar",
			"op1_?" => "Anv�nd valm�jligheterna nedan f�r att anpassa s�ttet som dina s�ksidor visas p� din webbsajt.",
			"op1_^" => "sub",
	
		"op2" => "Medlemskapsinst�llningar",
	
			"op2_$" => "halv",
			"op2_*" => "Medlemskapsinst�llningar",
			"op2_?" => "Anv�nd valm�jligheterna nedan f�r att anpassa s�ttet som medlemskapet p� din webbsajt visas.",
			"op2_^" => "sub",

		/*"op3" => "Flash Serverinst�llningar",
	
			"op3_$" => "halv",
			"op3_*" => "Flash Serverinst�llningar",
			"op3_?" => "En flash server anv�nds f�r att lagra medlemmarnas videoh�lsningar och anv�nds inom IM och chatrummen f�r att visa medlemmarnas videokameror.",
			"op3_^" => "sub",*/

		"op4" => "API inst�llningar",
	
			"op4_$" => "halv",
			"op4_*" => "API inst�llningar", 
			"op4_^" => "sub",

		"thumbnails" => "Standard thumbnailbilder",
	
			"thumbnails_$" => "halv",
			"thumbnails_*" => "Standard thumbnailbilder", 
			"thumbnails_^" => "Listade nedan finns alla nuvarande standardbilder som anv�nds p� din webbsajt n�r medlemmar inte har laddat upp egna foton.",

	"email" => "Epostinst�llningar",

		"email_$" => "halv",
		"email_*" => "Epostinst�llningar",
		"email_?" => "Nedan finns en lista med webbsajtsevenemang, du kan v�lja vilka h�ndelser du vill att systemet ska skicka dig epostmeddelande om. Epostmeddelande kommer att skickas till alla systemadministrat�rer som har tillg�ng till systeminst�llningar.",

	"paths" => "Fil/Mappv�gar",

		"paths_$" => "halv",
		"paths_*" => "Fil/Mappv�gar",
		"paths_?" => "Fil och mappv�garna nedan relaterar till filerna och mapparna p� ditt v�rdkonto. Mjukvaran kommer automatiskt att anv�nda dessa under installationsprocessen och om de skulle vara inkorrekta kan du �ndra dem nedan.",

	"watermark" => "Vattenst�mpel p� bild",

		"watermark_$" => "halv",
		"watermark_*" => "Vattenst�mpel p� bild",
		"watermark_?" => "En bildvattenst�mpel �r en bild som visas l�ngst upp p� medlemmarnas foton n�r de visas. Detta �r vanligtvis ett logo f�r din webbsajt, vattenst�mplar m�ste vara i formatet PNG, 8bit.",


);


$admin_layout_page8 = array(

	"" => "Webbsajtsf�lt",

		"_$" => "halv",
		"_*" => "Profil, registrering och s�kf�lt",
		"_?" => "Listade nedan finns alla nuvarande f�lt som finns listade p� din webbsajt. Du kan v�lja att visa f�lten p� s�ksidan, registreringssidorna, profilsidor och till och med p� medlemsmatchningssidor. Du kan snabbt och l�tt l�gga till nya f�lt till din webbsajt genom att anv�nda valm�jligheterna nedanf�r.",

		"fieldlist_*" => "List Box objekt", 
		
		"fieldedit_*" => "Redigera Caption", 

		"fieldeditmove_*" => "Flytta f�ltet till en annan grupp",
		
		"addfields" => "Skapa nytt f�lt",
	
			"addfields_$" => "halv",
			"addfields_*" => "Skapa nytt f�lt",
			"addfields_?" => "Anv�nd valm�jligheterna nedan f�r att l�gga till ett nytt f�lt p� din webbsajt. Ett f�lt anv�nds f�r att till�ta medlemmarna att fylla i information om sig sj�lva.",
			"addfields_^" => "sub",

		"fieldgroups" => "Hantera grupper",
	
			"fieldgroups_$" => "halv",
			"fieldgroups_*" => "Hantera f�ltgrupper",
			"fieldgroups_?" => "Grupper �r en samling av f�lt som har ett gemensamt tema. Du skapar till exempel en grupp som heter 'Om mig' och inom gruppen l�gger du till f�lt s� som 'Mitt namn', 'Min �lder' etc. <b>Om du tar bort en grupp med f�lt i s� kommer f�lten automatiskt att flyttas till n�sta grupp.",
			"fieldgroups_^" => "sub",

		"addgroups" => "Skapa ny f�ltgrupp",
	
			"addgroups_$" => "halv",
			"addgroups_*" => "Skapa ny f�ltgrupp",
			"addgroups_?" => "En f�ltgrupp �r en samling f�lt som alla s�tts under samma grupprubrik. Detta g�r det m�jligt f�r dig att skapa massor av grupper med f�lt som �r relaterade till grupptemat.",
			"addgroups_^" => "sub",




	"cal" => "Evenemangskalender",

		"cal_$" => "halv",
		"cal_*" => "Evenemangskalender",
		"cal_?" => "Evenemangskalendern visas p� din webbsajt f�r medlemmar f�r att skapa och se evenemang. Anv�nd valm�jligheterna nedan f�r att skapa, redigera och importera nya evenemang.",

		"caladd" => "L�gg till evenemang",
	
			"caladd_$" => "halv",
			"caladd_*" => "L�gg till/Redigera evenemang",
			"caladd_?" => "Fyll i f�lten nedan f�r att l�gga till/redigera ett webbsajtevenemang.",
			"caladd_^" => "sub",

		"caladdtype" => "Hantera evenemangtyper",
	
			"caladdtype_$" => "halv",
			"caladdtype_*" => "Hantera evenemangtyper",
			"caladdtype_?" => "Anv�nd valm�jligheterna nedan f�r att skapa nya evenemangtyper, det rekommenderas att l�gga till en bild f�r varje evenemang f�r att f� din webbsajt att se mer professionell ut.",
			"caladdtype_^" => "sub",

		"importcal" => "Importera evenemang",
	
			"importcal_$" => "halv",
			"importcal_*" => "S�k & Importera evenemang",
			"importcal_?" => "Mjukvaran har ett inbyggt evenemangs apisystem. Detta till�ter dig att s�ka i en v�rldsomfattande databas �ver lokala och internationella evenemang och l�gga till dem direkt p� din webbsajt.",
			"importcal_^" => "sub",


	"poll" => "Webbsajtsenk�t",

		"poll_$" => "halv",
		"poll_*" => "Webbsajtsenk�t",
		"poll_?" => "Anv�nd valm�jligheterna nedan f�r att skapa och hantera dina webbsajtsenk�ter",

		"polladd" => "L�gg till enk�t",
	
			"polladd_$" => "halv",
			"polladd_*" => "Skapa en ny enk�t",
			"polladd_?" => "Fyll i f�lten nedan f�r att skapa en ny enk�t till din webbsajt.",
			"polladd_^" => "sub",



	"forum" => "Webbsajtsforum",

		"forum_$" => "halv",
		"forum_*" => "Kategorier f�r webbsajtsforum",
		"forum_?" => "Anv�nd valm�jligheterna nedan f�r att hantera kategorier f�r ditt webbsajtsforum. Det rekommenderas att man l�gger till fotoikoner f�r varje kategori f�r att f� din webbsajt att se mer professionell ut.",

		"forumadd" => "L�gg till forumkategori",
	
			"forumadd_$" => "halv",
			"forumadd_*" => "L�gg till forumkategori",
			"forumadd_?" => "Fyll i f�lten nedan f�r att l�gga till en ny kategori p� din webbsajt.",
			"forumadd_^" => "sub",

		"forumchange" => "Tredje parts forum",
	
			"forumchange_$" => "halv",
			"forumchange_*" => "Hantera forumintegration",
			"forumchange_?" => "Mjukvaran ger dig f�rm�ga att �ndra forumtavlan, detta betyder att du kan v�lja att anv�nda vilket som helst av forumen i listan nedan ist�llet f�r standardforumet. V�nligen g� till installationsmanualen f�r varje forum innan du v�ljer ut en forumtavla.",
			"forumchange_^" => "sub",

		"forumpost" => "Hantera inl�gg",
	
			"forumpost_$" => "halv",
			"forumpost_*" => "Hantera foruminl�gg",
			"forumpost_?" => "Listade nedan finns alla de senaste foruminl�ggen publicerade av dina medlemmar. Anv�nd valm�jligheterna nedan f�r att redigera eller ta bort �mnen som inte �r godtagbara.",
			"forumpost_^" => "sub",

	"chatrooms" => "Webbsajtens chatrum",

		"chatrooms_$" => "halv",
		"chatrooms_*" => "webbsajtens chatrum",
		"chatrooms_?" => "Anv�nd valm�jligheterna nedanf�r f�r att skapa nya chatrum f�r din webbsajt eller redigera de redan existerande.",


	"faq" => "webbsajtsFAQ",

		"faq_$" => "halv",
		"faq_*" => "webbsajtsFAQ",
		"faq_?" => "webbsajtsFAQ �r ett bra s�tt att hj�lpa medlemmar l�ra sig mer om din webbsajt och svara p� alla problem som de kan t�nkas ha. Skapa din egen upps�ttning av FAQ och hantera dem genom att anv�nda valm�jligheterna nedanf�r.",

		"faqadd" => "L�gg till FAQ",
	
			"faqadd_$" => "halv",
			"faqadd_*" => "L�gg till/redigera FAQ",
			"faqadd_?" => "Fyll i f�lten nedanf�r f�r att l�gga till eller redigera ett inl�gg i FAQ.",
			"faqadd_^" => "sub",

	"words" => "Ordfilter",

		"words_$" => "halv",
		"words_*" => "Ordfilter",
		"words_?" => "Ordfiltret anv�nds p� medlemsprofiler, IM och forum och kommer att filtrera ut de ord du skriver in h�r och ers�tta dem med stj�rnor (**).",



	"articles" => "Webbsajtsartiklar",

		"articles_$" => "halv",
		"articles_*" => "Webbsajtsartiklar",
		"articles_?" => "Webbsajtsartiklar �r ett bra s�tt att h�lla dina medlemmar uppdaterade med de senaste �ndringarna p� webbsajten f�r nyheter och evenemang",


		"articleadd" => "L�gg till artikel",
	
			"articleadd_$" => "halv",
			"articleadd_*" => "Skapa en ny artikel",
			"articleadd_?" => "Fyll i f�lten nedanf�r f�r att l�gga till en ny artikel p� din webbsajt.",
			"articleadd_^" => "sub",

		"articlerss" => "Importera RSS-artiklar",
	
			"articlerss_$" => "halv",
			"articlerss_*" => "Importera RSS-artiklar",
			"articlerss_?" => "RSS-l�nkarna kan anv�ndas f�r att importera RSS-artikla direkt in i en av kategorierna du har skapat. Du kan till exempel vilja skapa en 'Nyheter' kategori och skriva in RSS-fl�de fr�n en webbsajt med nyheter. Mjukvaran kommer d� automatiskt att extrahera alla artiklar fr�n RSS-fl�det och l�gga till dem p� din webbsajt.",
			"articlerss_^" => "sub",

		"articlecats" => "Artikelkategorier",
	
			"articlecats_$" => "halv",
			"articlecats_*" => "Artikelkategorier",
			"articlecats_?" => "Anv�nd valm�jligheterna nedanf�r f�r att skapa nya artikelkategorier till din webbsajt.",
			"articlecats_^" => "sub",


	"groups" => "Communitygrupper",

		"groups_$" => "halv",
		"groups_*" => "Communitygrupper",
		"groups_?" => "Anv�nd valm�jligheterna nedanf�r f�r att skapa och hantera communitygrupperna p� din webbsajt.",


	"class" => "Rubrikannonser",

		"class_$" => "halv",
		"class_*" => "Rubrikannonser",
		"class_?" => "Listade nedanf�r finns alla rubrikannonser skapade av dina medlemmar.",


		"addclass" => "Rubrikannonser",
	
			"addclass_$" => "halv",
			"addclass_*" => "L�gg till/redigera annons",
			"addclass_?" => "Anv�nd valm�jligheterna nedan f�r att l�gga till/redigera annonserna p� din webbsajt.",
			"addclass_^" => "sub",

		"addclasscat" => "Hantera kategorier",
	
			"addclasscat_$" => "halv",
			"addclasscat_*" => "Hantera kategorier",
			"addclasscat_?" => "Anv�nd valm�jligheterna nedan f�r att hantera dina rubrikannonskategorier. Det rekommenderas att man l�gger till en fotoikon f�r varje f�r att f� din webbsajt att se mer professionell ut.",
			"addclasscat_^" => "sub",

	"games" => "Webbsajtsspel",

		"games_$" => "halv",
		"games_*" => "Webbsajtsspel",
		"games_?" => "Listade nedan finns alla spel som nu finns p� din webbsajt. Se manualen f�r information om hur man installerar nya spel",

	"gamesinstall" => "Installera spel",

		"gamesinstall_$" => "halv",
		"gamesinstall_*" => "Installera spel",
		"gamesinstall_?" => "V�lj spelen nedan som du vill installera. Om du vill l�gga till nya spel till din webbsajt laddar du helt enkelt upp tarfilerna f�r spelet till din spelmapp som finns i: inc/exe/Games/tar/. <b>Titta i manualen f�r information om hur man installerar nya spel</b>",
		"gamesinstall_^" => "sub",


);


$admin_layout_page9 = array(

	"" => "Administrat�rer",

		"_$" => "halv",
		"_*" => "webbsajtsadmin & moderatorer",
		"_?" => "Listade nedan finns alla webbsajtens admins och moderatorer f�rutom superanv�ndaren. L�gg till nya moderatorer genom att anv�nda medlemss�ksidan och klicka p� moderatorikonen bredvid deras namn.",

	"pref" => "Adminpreferenser",

		"pref_$" => "halv",
		"pref_*" => "Adminpreferenser",
		"pref_?" => "Anv�nd valm�jligheterna nedanf�r f�r att anpassa administratorspreferenserna.",

	"manage" => "Hantera moderatorer",

		"manage_$" => "halv",
		"manage_*" => "Hantera webbsajt Hantera moderatorer",
		"manage_?" => "En webbsajtsmoderator kan ha tv� roller, de kan vara en webbsajtsmoderator som till�ter dem tillg�ng att moderera enbart huvudwebbsajten eller s� kan du ge dem deras egna inloggningsuppgifter som admin s� att de kan logga in i adminomr�det och anv�nda adminverktygen.",

	"email" => "Epost f�r admin",

		"email_$" => "halv",
		"email_*" => "Epost f�r admin",
		"email_?" => "Listade nedan finns alla epost skickade till admin fr�n webbsajtens medlemmar.",

	"compose" => "Skriv epost",

		"compose_$" => "halv",
		"compose_*" => "Skriv epost",
		"compose_?" => "Anv�nd valm�jligheterna nedanf�r f�r att skapa ett nytt meddelande att skicka till en medlem.",
		"compose_^" => "sub",

	"super" => "Superanv�ndarinloggning",

		"super_$" => "halv",
		"super_*" => "Superanv�ndare inloggningsinformation",
		"super_?" => "V�nligen var f�rsiktig n�r kontoinformationen nedan redigeras, detta �r superanv�ndarkontot och du b�r se till att l�senordet f�rvaras s�kert fr�n andra hela tiden.",
		"super_^" => "sub",
);

$admin_layout_page10 = array(

	"" => "Mjukvaruuppdateringar",

		"_$" => "halv",
		"_*" => "Mjukvaruuppdateringar",
		"_?" => "Listad nedanf�r �r den nuvarande versionen av mjukvaran du anv�nder j�mf�rd med den senaste tillg�ngliga versionen. Om din version �r f�r gammal, v�nligen kontakta din leverant�r f�r de senaste uppgraderingarna.",

	"backup" => "Databasbackup",

		"backup_$" => "halv",
		"backup_*" => "Databasbackup",
		"backup_?" => "V�lj en eller flera av tabellerna nedan f�r att g�ra backup p� databasen. Det �r starkt rekommenderat att du anv�nder v�rdomr�dets funktioner f�r databasbackup f�r att se till att all information �r mottagen.",


	"license" => "Licensnyckel f�r mjukvara",

		"license_$" => "halv",
		"license_*" => "Licensnyckel f�r mjukvara",
		"license_?" => "Listade nedan finns dina licensnycklar, v�nligen ta dessa vid redigering f�r att se till att de �r korrekta.",

	"sms" => "SMS-krediter",

		"sms_$" => "halv",
		"sms_*" => "SMS-krediter",
		"sms_?" => "Listade nedan finns det totala antalet SMS-krediter som finns kvar p� ditt konto.",

);

$admin_layout_page11 = array(

	"" => "Mjukvaruplugins",

		"_$" => "halv",
		"_*" => "Mjukvaruplugins",
		"_?" => "Plugins expanderar funktionaliteten av eMeeting datingmjukvara. N�r en plugin �r installerad kan du aktivera eller avaktivera den h�r genom att anv�nda menyvalen till v�nster.",

);


$admin_layout_nav = array(

	"1" => "Instrumentbr�da",
		"1a" => "Medlemsstatistik",
		"1b" => "Affiliatestatistik",
		"1c" => "Bes�ksstatistik",
		"1d" => "Bes�karnas lokalisering",
	"2" => "Medlemmar",
		"2a" => "Hantera medlemmar",
		"2b" => "Hantera affiliates",
		"2c" => "F�rbjudna medlemmar",
		"2d" => "Medlemsfiler",
		"2e" => "Importera medlemmar",
	"3" => "Design",
		"3a" => "Teman",
		"3b" => "Temaeditor",
		"3c" => "Tema bildhanterare",
		"3d" => "Logoeditor",
		"3e" => "Metataggar",	
		"3f" => "Spr�k",
		"3g" => "Sidoordval",
		"3h" => "Filhanterare",
		"3i" => "Menyknappar",
	"4" => "Epost",
		"4a" => "Hantera epost",
		"4b" => "Epostmallar",
		"4c" => "Epostrapporter",
		"4d" => "Skicka enskilt epostmeddelande",
		"4e" => "Epostp�minnelse",	
		"4f" => "Ladda ner epost",
		"4g" => "Skicka nyhetsbrev",		
	"5" => "Fakturering",
		"5a" => "Hantera paket",
		"5b" => "Betalningsportar",
		"5c" => "Faktureringshistorik",
		"5d" => "Affiliate faktureringshistorik",
	"6" => "Inst�llningar",
		"6a" => "Visningsval",
		"6b" => "Visningsinst�llningar",
		"6c" => "Systemstigar",
		"6d" => "Foto vattenst�mpel",
	"7" => "Inneh�ll",
		"7a" => "S�k f�lt",
		"7b" => "Evenemangkalender",
		"7c" => "Webbsajtsenk�t",
		"7d" => "Webbsajtsforum",
		"7e" => "Chatrum",	
		"7f" => "FAQ",
		"7g" => "Ordfilter",
		"7h" => "Artiklar/Nyheter",
		"7i" => "Grupper",
	"8" => "Kampanjer",	
		"8a" => "Banners",
	"9" => "Plugins",	
		"9a" => "",
	"10" => "Hantera moderatorer",	
		"10a" => "Hantera moderatorer",
		"10b" => "Superanv�ndare",
	"11" => "Underh�ll",
		"11a" => "Systembackup",
		"11b" => "Licensnycklar",
		"11c" => "Systemuppdateringar",
);

// MEMBERS PAGE
$lang_members_code = array(
	"update" => "System uppdaterades framg�ngsrikt",
	"no_update" => "System uppdaterat, det fanns dock inget att ta bort!",
	"edit" => "Redigera",
);
$GLOBALS['lang_admin_edit'] = " ".$lang_members_code['edit'];

$admin_button_val = array(
	"0" => "S�k",
	"1" => "V�lj alla",
	"2" => "Avmarkera alla",
	"3" => "Godk�nn",
	"4" => "St�ng av",
	"5" => "Ta bort",	
	"6" => "G�r utvald medlem",
	"7" => "Valm�jligheter",	
	"8" => "Uppdatera",	
	"9" => "G�r utvalda",
	"10" => "Ta bort utvalda",	
	"11" => "Uppdatera standardspr�k",
	"12" => "Skicka",
	"13" => "Forts�tt",	
	"14" => "G�r aktiv",
	"15" => "G�r inaktivt",
	"16" => "Uppdatera best�llning",
	"17" => "Uppdatera f�ltsidor",	
	"18" => "G�r aktivt",
);

$admin_table_val = array(
	"1" => "Anv�ndarnamn",
	"2" => "K�n",
	"3" => "Senaste inloggning",
	"4" => "Status",
	"5" => "Paket",
	"6" => "Uppdaterad",
	"7" => "Valm�jligheter",	
	"8" => "Datum",
	"9" => "IP-adress",
	"10" => "Hackserie",	
	"11" => "Registreringsdatum",	
	"12" => "Namn",
	"13" => "Epost",
	"14" => "Klick",
	"15" => "Registreringar",
			
	"15" => "Betald provision",
		
	"16" => "Meddelande",
	"17" => "Tid",
	"18" => "Filnamn",
	"19" => "Senast uppdaterad",	
	"20" => "Redigera",
	"21" => "Standard",	
	"22" => "ID",

	"23" => "Pris",
	"24" => "Synlig",	
	"25" => "Typ",
	"26" => "Hantera tillg�ng",	
	"27" => "Aktiv",

	"28" => "Se kod",
	"29" => "F�lt",	
	"30" => "Affiliatenamn",
	"31" => "Totalt f�rfallet",	
	"32" => "Status",
	
	"33" => "Uppgraderingsdatum",
	"34" => "Utg�ngsdatum",	
	"35" => "Betalningsmetod",
	"36" => "Fortfarande aktiv",	
	"37" => "L�senord",
	"38" => "Senast inloggad",

	"39" => "Position",
	"40" => "Tr�ffar",	
	"41" => "Aktiv",
	"42" => "F�rhandstitt",	
	"43" => "Titel",
	"44" => "Artiklar",
	"45" => "Best�ll",

);

$admin_search_val = array(
	"1" => "Medlemmens anv�ndarnamn",
	"2" => "Alla paket",
	"3" => "Alla k�n",
	"4" => "Per sida",
	"5" => "Best�ll av",
	"6" => "Epostadress",
	
	"7" => "Vilken status som helst",
	"8" => "Aktiva medlemmar",
	"9" => "Avst�ngda medlemmar",
	"10" => "Icke godk�nda medlemmar",
	"11" => "Medlemmar som vill avsluta",
	"12" => "Alla sidor",
);
////////////////////////// MAIN PAGES ////////////////////////////////////
$admin_management = array(

	"1" => "Hantera alla grupper",
	"2" => "Gruppnamn",
	"3" => "Spr�k",		
	"4" => "Hantera �mnen",
	"5" => "Hantera kategorier",	
	"6" => "Gruppkategorinamn",		
	"7" => "Hantera kategorier",	
	"8" => "Namn",	
	"9" => "R�kna",	
	"10" => "L�gg till artikel",	
	"11" => "Kategori",
	"12" => "Sidotitel",	
	"13" => "Kort beskrivning",		
	"14" => "L�gg till artikel",
	"15" => "Hantera kategorier",
	"16" => "F�ltlista",
	"17" => "Best�ll",
	"18" => "Spr�k",
	"19" => "Listv�rden",
	"20" => "Nytt f�lt",	
	
	"21" => "F�lttitel",		
	"22" => "F�lttyp",
		"23" => "Textf�lt",	
		"24" => "Textomr�de",	
		"25" => "Listruta",
		"26" => "Enskild kryssruta",
		"27" => "Flertal checkruta",
	
	"28" => "Grupprubrik",
	"29" => "Inkludera under registrering",
	"30" => "V�lj nedanf�r",
	
	"31" => "L�gg till grupp",
	"32" => "Gruppvisningsval",
		"34" => "Visa f�r alla medlemmar",
		"35" => "Visa enbart f�r webbsajtsadmin",
		"36" => "Visa f�r admin och medlemmar (inte p� profil)",
	"37" => "Bara",	
	"38" => "Hantera grupper",	
	"39" => "L�gg till evenemang",	
	"40" => "F�lttext",
	"41" => "Text",		
	"42" => "Beskrivningstyp",
	"43" => "Texttyp",	
	"44" => "S�ktext",		
	"45" => "Profiltext",	
	"46" => "Du m�ste skapa en text f�r profilsidan s� som 'jag �r en' och en till s�ksidan s� som 'jag s�ker en'",	
	"47" => "Existerande f�lttext",	
	"48" => "Flytta f�lt till denna grupp",		
	"49" => "Medlems-ID",
	"50" => "Evenemangsnamn",	
	"51" => "Evenemangsbeskrivning",		
	"52" => "Evenemangstyp",
	"53" => "V�lj kategori",	
	"54" => "V�lj typ",
	"55" => "Evenemangstid",
	"56" => "L�mna tom f�r hela dagen",
	"57" => "Evenemangsdatum",
	"58" => "M�nad",	
	
	"59" => "Dag",	
	"60" => "�r",
	"61" => "Land",		
	"62" => "L�n/landskap",
	"63" => "Gata",	
	"64" => "Ort/stad",		
	"65" => "Telefon",	
	"66" => "Epost",	
	"67" => "Webbsajt",	
	"68" => "Evenemang synligt f�r",		
		"69" => "Alla",
		"70" => "Enbart v�nner",	
		
	"71" => "L�gg till enk�t",		
	"72" => "Enk�tresultat p� webbsajt",
	"73" => "Enk�tnamn",	
	"74" => "Svara",	
	"75" => "G�r aktiv",
	
	"76" => "L�gg till forum�mne",
	"77" => "Hantera inl�gg",
	"78" => "Forum�mne",	
		
	"79" => "Titel",	
	"80" => "Beskrivning",
	"81" => "Foruminl�gg",		
	"82" => "Alla inl�gg",
	"83" => "Idag",	
	"84" => "Denna veckan",		
	"85" => "F�rra veckan",	
	"86" => "Rumsnamn",	
	"87" => "Existerande f�lttext",	
	"88" => "L�senord till rum",		
	"89" => "L�gg till ny",
	"90" => "L�gg till F.A.Q",
	
	"91" => "L�gg till ordcensur",		
	"92" => "Ord",
	
	"93" => "Godk�nd",
	"94" => "Text",
	"95" => "Matchningstext",
	"96" => "Spr�k",

	"97" => "F�rhandstitt",
	"98" => "Resultat",
);
$admin_advertising = array(

	"1" => "Webbsajtsbanner",
	"2" => "L�gg till banner",
	"3" => "Affiliatebanner",	
	"4" => "L�gg till/redigera banner",
	"5" => "Bannertyp",	
	"6" => "Webbsajtsbanner",			
	"7" => "Affiliatebanner",	
	"8" => "Namn",	
	"9" => "Ladda upp banner",	
	"10" => "Skriv in HTML",	
	"11" => "HTML-kod",
	"12" => "Ladda upp banner",	
	"13" => "Bannerl�nk",		
	"14" => "Visa f�r",
		"15" => "Alla medlemmar",
		"16" => "Enbart inloggade medlemmar",
	
	"17" => "Sida",
	"18" => "Aktiv",
	
	"19" => "Topposition",
	"20" => "Mittenposition",	
	"21" => "V�nsterposition",		
	"22" => "Bottenposition",
	"23" => "L�mna tom f�r att anv�nda l�nk inom bannerkod",
	"24" => "F�rhandstitt p� banner",
	
);


$admin_maintenance = array(

	"1" => "Nu k�rs",
	"2" => "Senaste versionen",
	"3" => "SMS-krediter",	
	"4" => "�terst�ende SMS-krediter",	
	"5" => "K�p krediter",	

);

$admin_admin = array(

	"1" => "L�gg till admin",
	"2" => "Anv�ndarnamn",
	"3" => "L�senord",	
	"4" => "Epost",
	
	"5" => "Redigera admininst�llningar",	
	"6" => "Fullst�ndigt namn",			
	"7" => "Tillg�ngsniv�",	
		"8" => "Full systemtillg�ng",	
		"9" => "Enbart medlemstillg�ng",	
		"10" => "Enbart designtillg�ng",	
		"11" => "Enbart eposttillg�ng",
		"12" => "Enbart faktureringstillg�ng",	
		"13" => "Enbart inst�llningstillg�ng",		
		"14" => "Enbart styrningstillg�ng",
	"15" => "Adminikon",

	"17" => "Epostlarm",
	"18" => "Admin nyhetsmeddelande",
	"19" => "Flytta �ver medlemmar fr�n",
	"20" => "Till f�ljande paket",	
	"21" => "Redigera paket",		
	"22" => "Pakettillg�ng",
	"23" => "L�gg till paketartikel",	
	"24" => "Hantera pakettillg�ng",
);

$admin_settings = array(

	"1" => "Visa sidor",
	"2" => "Aktiverad",
	"3" => "Avaktivera",	
	"4" => "Webbv�gar",
	"5" => "Serverv�gar",	
	"6" => "Thumbnailv�gar",			
	"7" => "L�gg till f�lt",	
	"8" => "Namn",	
	"9" => "V�rde",	
	"10" => "Typ",	
	"11" => "Hantera f�lt",
	"12" => "L�gg till portar",	
	"13" => "Betalningssystem",		
	"14" => "Betalningskod f�r port",
	"15" => "Titel",
	"16" => "Pakettillg�ng",
	"17" => "Kommentarer",
	"18" => "Flytta �ver medlemmar",
	"19" => "Flytta �ver alla medlemmar fr�n",
	"20" => "Till f�ljande paket",	
	"21" => "Redigera paket",		
	"22" => "Pakettillg�ng",
	"23" => "L�gg till paketartikel",	
	"24" => "Hantera pakettillg�ng",
);

$admin_billing = array(

	"1" => "L�gg till paket",
	"2" => "Hantera pakettillg�ng",
	"3" => "Flytta �ver medlemspaket",			
	"4" => "Din webbsajt k�rs f�r n�rvarande i <b>FRITT L�GE</b> eftersom medlemskapspaket har avaktiverats.",
	"5" => "Skulle du vilja avaktivera fritt l�ge och visa medlemspaket?",	
	"6" => "AVAKTIVERA FRITT L�GE",		
	"7" => "L�gg till f�lt",	
	"8" => "Namn",	
	"9" => "V�rde",	
	"10" => "Typ",	
	"11" => "Hantera f�lt",
	"12" => "L�gg till portar",	
	"13" => "Betalningssystem",		
	"14" => "Betalningskod f�r port",
	"15" => "Titel",
	"16" => "Pakettillg�ng",
	"17" => "Kommentarer",
	"18" => "Flytta �ver medlemmar",
	"19" => "Flytta �ver alla medlemmar fr�n",
	"20" => "Till f�ljande paket",	
	"21" => "Redigera paket",		
	"22" => "Pakettillg�ng",
	"23" => "L�gg till paketartikel",	
	"24" => "Hantera pakettillg�ng",
	
	"25" => "V�ntar p� godk�nnande",
	"26" => "Godk�nda betalningar",
	"27" => "Nekade betalningar",
	
	"28" => "All historik",
	"29" => "Aktiva betalningar",
	"30" => "Slutf�rda betalningar",
	"31" => "Aktiva anm�lningar",
	"32" => "Slutf�rda anm�lningar",
	"33" => "Accesskod till paket",
	
);

$admin_email = array(

	"1" => "Systemepost",
	"2" => "Nyhetsbrev",
	"3" => "Epostmallar",		
	"4" => "Eposteditor",
	"5" => "�mne",	
	"6" => "F�rhandstitta p� epost",	
	"7" => "Till epost",
	
	"8" => "Skicka till",	
		"9" => "Alla medlemmar",	
		"10" => "Anm�lare till medlemskapspaket",	
		"11" => "Aktiva / Avst�ngda / Icke godk�nda medlemmar",
	"12" => "Till paket",	
	"13" => "Medlemskapstatus",		
	"14" => "V�lj nyhetsbrev",	
	
	"15" => "Skapa ny",
	"16" => "Se skapad praxis",
	"17" => "Epost sp�rningskod",
	"18" => "Skapa ny",
	"19" => "Se skapad praxis",
	"20" => "Epost sp�rningskod",
		"21" => "HTML-kod nedanf�r",
		
	"22" => "Epost sp�rningsresultat",
	"23" => "Inga rapporter hittades.",
	"24" => "V�lj rapport",
	
	"25" => "Skicka p�minnelse till alla medlemmar som har mellan",
	"26" => "och",
	"27" => "dagar",
	"28" => "Dagar kvar av deras uppgradering",
	"29" => "V�lj epost att skicka:",
	"30" => "Ladda ner",
	"31" => "V�lj paket",
	"32" => "Sp�rningskod",
	
	
);

$admin_design = array(

	"1" => "Ladda ner teman",
	"2" => "Nuvarande mall",
	"3" => "Anv�nd denna mall",	
	"4" => "Metataggar f�r sida",
	"5" => "Sidotitel",	
	"6" => "Beskrivning",
	"7" => "Nyckelord",
	"8" => "Webbsajtssidor",	
	"9" => "Inneh�llssidor",	
	"10" => "Praxissidor",	
	"11" => "Skapa sida",
	"12" => "FTP stig",	
	"13" => "Temafiler",		
	"14" => "Inneh�llssidor",	
	"15" => "Praxissidor",


	"16" => "L�gg till spr�k",
	"17" => "Nytt filnamn",	
	"18" => "V�lj fil att kopiera",
			
	"19" => "Redigera spr�kfil",	
	"20" => "Praxissidor",

	"21" => "Text",
	"22" => "Textstorlek",	
	"23" => "Textf�rg",
	"24" => "bredd",	
	"25" => "h�jd",		
	"26" => "L�gg till logotext",
	"27" => "Canvastyp",	
		"28" => "Anv�nd tom canvas",
		"29" => "Beh�ll nuvarande design",	
		"30" => "Ladda upp min egen bakgrund/logo",	

	"31" => "Skapa ny sida",
	"32" => "Nytt sidonamn",	
		"33" => "Sidonamn b�r vara mycket korta och enbart ett ord. Till exempel l�nkar, artiklar, nyheter, forum, etc",
	"34" => "L�gg till menyknapp?",	
		"35" => "Nej! Skapa inte en knapp",		
		"36" => "Ja. L�gg till det i medlemsavdelningen",
		"37" => "Ja. L�gg till det p� webbsajtens huvudsidor, inte medlemsomr�det.",
			"38" => "Om man valt det kommer en ny medlemsknapp att genereras p� din webbsajt",
);

$admin_overview = array(

	"1" => "Meddelande",
	"2" => "Totalt antal medlemmar",
	"3" => "Denna vecka",
	"3a" => "Idag",
	"4" => "Senaste webbsajtsaktiviteten",
	"5" => "Webbsajtrapporter",
	
	"6" => "Unika bes�kare p� webbsajten under de senaste tv� veckorna",
	"7" => "Nya registrerade medlemmar de senaste 2 veckorna",
	"8" => "Medlemmarna k�nstatistik",	
	"9" => "Medlemmarnas �lderstatistik",
	
	"10" => "Nya affiliateregistreringar de senaste 2 veckorna",
	"11" => "Bes�kares kartinst�llningar",
	"12" => "V�nligen skriv in din Google API nyckel i f�ltet ovanf�r.",	
	"13" => "Du kan k�pa en licensnyckel fr�n kundomr�det p� v�r webbsajt",	
	
	"14" => "Filters�kresultat",	
	"15" => "Alla filer",
	
);
$admin_members = array(

	"1" => "Alla medlemmar",
	"2" => "Moderatorer",
	"3" => "Aktiv",
	"4" => "Avst�ngd",
	"5" => "Icke godk�nda",
	"6" => "�nskar avbryta",
	"7" => "Online nu",
	"8" => "Inloggningsaktivitet f�r medlem",	
	"9" => "Redigera medlemsinformation",	
	"10" => "L�gg till affiliate",
	"11" => "Affiliatebanners",
	"12" => "Affiliatesidor",	
	"13" => "L�gg till affiliate",	
	"14" => "Affiliateinst�llningar",	
	"15" => "Alla filer",
	"16" => "Foton",
	"17" => "Videos",
	"18" => "Musik",
	"19" => "YouTube",
	"20" => "Icke godk�nd",
	"21" => "Utvald",
	"22" => "Ladda upp fil",	
	"23" => "Fil",
	"24" => "Typ",
	"25" => "Anv�ndarnamn",
	"26" => "Titel",
	"27" => "Kommentarer",
	"28" => "G�r till standard",		
	"29" => "Inloggningsaktivitet f�r medlem",	
	"30" => "Affiliates registrerade",
	"31" => "Utvald",
	"a5" => "Anv�ndarnamn",
	"a6" => "L�senord",
	"a7" => "F�rnamn",
	"a8" => "Efternamn",
	"a9" => "F�retagsnamn",
	"a10" => "Adress",
	"a11" => "Gata",
	"a12" => "Ort/Stad",
	"a13" => "Landskap/L�n",
	"a14" => "Postnummer",
	"a15" => "Land",
	"a16" => "Telefon",
	"a17" => "Fax",
	"a18" => "Epost",
	"a19" => "Webbsajtsadress",
	"a20" => "G�r check betalbar till",
);


// HELP FILES
$admin_help = array(

	"a" => "Kom ig�ng nu",
	"b" => "Nej, det �r bra. Tack!",
	"c" => "Forts�tt",	
	"d" => "St�ng f�nster",
	
	
	"1" => "Introduktion",
	"2" => "Beh�ver du hj�lp f�r att komma ig�ng?",
	"3" => "Hej",	
	
	"4" => "och v�lkommen till adminstrationsomr�det! Eftersom detta �r f�rsta g�ngen du loggar in p� administrationsomr�det rekommenderar vi att du tar dig tid n�gra f� minuter och f�ljer guiden nedanf�r f�r att f� hj�lp till att komma ig�ng!",
	"5" => "V�r kom ig�ng-guide kommer att guida dig genom vanliga inst�llningssteg och f� ig�ng dig p� nolltid.",	
	"6" => "<strong>(Note)</strong> Du kan komma tillbaka till denna sida n�r som helst genom att klicka p� 'snabbhj�lpsguiden' p� den v�nstra menyknappen.",
	
	"7" => "Komma ig�ng",
	"8" => "V�lkommen till ditt adminomr�de!",	
	"9" => "V�lkommen till adminkontoomr�det f�r",	
	"10" => "Denna mjukvara till�ter dig att hantera alla olika aspekter av din webbsajt, inklusive dina medlemmar, filer, s�kerhet, epost, plugins, och en massa annat.",	
	"11" => "Denna guide f�r att komma ig�ng kommer att introducera dig f�r n�gra av koncepten bakom webbsajtsstyrande och till�ter dig att konfigurera n�gra grundl�ggande inst�llningar f�r din webbsajt s� att du kan b�rja driva in trafik (bes�kare) till din webbsajt.",
	"12" => "<strong>(Kom ih�g)</strong> Du kan n�r som helst st�nga detta f�nster genom att anv�nda st�ngningsknappen och komma tillbaka senare genom att klicka p� 'snabbhj�lpsguiden' fr�n den v�nstra menyknappen.",
		
	"13" => "Introduktion till ditt administrationsomr�de!",		
	"14" => "Mjukvarans administrationsomr�de �r 'webbaserad' vilket inneb�r att du kan komma �t och hantera din webbsajt vart du �n befinner dig i v�rlden med hj�lp av en internetuppkoppling. St�ll bara in din browser p�:",	
	"15" => "och logga in med dina inloggningsuppgifter f�r admin.",
	"16" => "Klicka h�r f�r att s�tta bokm�rke p� denna l�nk nu.",
	
	"17" => "Introduktion till din instrumentbr�da.",	
	"18" => "Mjukvarans instrumentbr�da ger dig en v�ldigt snabb �versikt av din webbsajts prestation, du kan l�sa mjukvarumeddelanden, se medlemmars registreringshistorik, se medlemsstatistik och affiliatestatistik bland annat.",			
	"19" => "All medlemsinformation lagras i MYSQL databasen som heter:",	
	"20" => "Introduktion till webbsajtsstatistik.",
	"21" => "Mjukvarans statistik ger dig en visuell representation av registreringshistoriken f�r medlemmar och affiliates �ver en tv�veckorsperiod. Varje g�ng en medlem eller affiliate ansluter sig till din webbsajt sparas tid och datum och ritas in p� grafer.",
	
	"22" => "Introduktion till bes�karnas bel�genhet",		
	"23" => "Introduktion till att hantera dina medlemmar",	
	"24" => "Introduktion till att hantera dina affiliates",	
	"25" => "Introduktion till att hantera dina f�rbjudna medlemmar",		
	"26" => "Introduktion till att hantera dina medlemsfiler",
	"27" => "Introduktion till att importera medlemmar",	
	"28" => "Introduktion till webbsajtsteman",
	"29" => "Introduktion till temaeditorn",	
	"30" => "Introduktion till temabildhanteraren",
	"31" => "Introduktion till logoeditor",
	"32" => "Introduktion till metataggar",	
	"33" => "Introduktion till spr�k",
	"34" => "Introduktion till eposthantering",	
	"35" => "Introduktion till epostmallar",		
	"36" => "Introduktion till epostrapporter",
	"37" => "Introduktion till skicka nyhetsbrev",
	"38" => "Introduktion till epostp�minnelser",
	"39" => "Introduktion till nerladdning av epostadresser",
	"40" => "Introduktion till medlemskapspaket",
	"41" => "Introduktion till betalningsportar",
	"42" => "Introduktion till faktureringshistorik f�r medlemskap",
	"43" => "Introduktion till faktureringshistorik f�r affiliates",
	"44" => "Introduktion till visningsval",
	"45" => "Introduktion till visningsinst�llningar",
	"46" => "Introduktion till systemstigar",
	"47" => "Introduktion till vattenst�mpel",
	"48" => "Introduktion till s�kf�lt",
	"50" => "Introduktion till evenemangskalender",
	"51" => "Introduktion till webbsajtsenk�t",
	"52" => "Introduktion till webbsajtsforum",
	"53" => "Introduktion till chatrum",
	"54" => "Introduktion till webbsajtsFAQ",
	"55" => "Introduktion till ordfilter",
	"56" => "Introduktion till nyheter/artiklar",
	"57" => "Introduktion till grupper",

		"22a" => "Bes�karnas bel�genhetskarta markerar bel�genheten f�r var och en av dina webbsajtsmedlemmar och till�ter dig att med en snabb blick se vilka l�nder dina medlemmar kommer fr�n.",		
		"23a" => "Medlemshanteringsverktyget till�ter dig att se alla medlemmar som har g�tt med p� din webbsajt. Anv�nd s�kverktyget f�r att filtrera bland dina medlemmar f�r att redigera, uppdatera och ta bort medlemsprofiler.",	
		"24a" => "Affiliatehanteringsverktyget till�ter dig att med en snabb blick se alla affiliates p� din webbsajt. Du kan se, redigera och ta bort affiliates fr�n din webbsajt och godk�nna nya registrerade affiliates.",	
		"25a" => "Sektionen f�r f�rbjudna medlemmar lagrar allt om medlemmar och icke medlemmar som f�rs�ker hacka din webbsajt. Mjukvaran kommer automatiskt att f�rbjuda misst�nkta medlemmar fr�n att se din webbsajt f�r att f�rhindra att de orsakar n�gon skada.",		
		"26a" => "Medlemsfilverktyget till�ter dig att se alla medlemmarnas uppladdningar, musik, video, foton, etc kan alla hanteras h�r. Klicka p� n�got av fotona f�r att redigera fotot med hj�lp av v�rt inbyggda sk�rverktyg.",
		"27a" => "Medlemsimportverktyget till�ter dig att importera medlemmar fr�n andra mjukvaruapplikationer. Du skriver helt enkelt in databasinformationen f�r den webbsajt d�r ditt gamla system �r lagrat och det kommer att �verf�ras till din nya webbsajt.",	
		"28a" => "Temaavdelningen p� webbsajten till�ter dig att �ndra mallen f�r webbsajten och designen p� din egen sajt omedelbart! Klicka bara p� temat du vill anv�nda och din webbsajt blir omedelbart uppdaterad.",
		"29a" => "Temaeditorverktyget till�ter dig att redigera webbsajtssidorna direkt fr�n administrationsomr�det. Du kanske ocks� vill kopiera och klistra in koden i din egen webbsajtseditor och sedan klistra tillbaka den igen n�r du har slutf�rt redigeringen.",	
		"30a" => "Temabildhanteraren till�ter dig att �ndra de nuvarande bilderna p� din webbsajt genom att ladda upp nya. Nya bilder kommer att ers�tta de nuvarande bilderna och direkt l�ggas till p� din webbsajt.",
		"31a" => "Logoeditorverktyget till�ter dig att �ndra designen p� din nuvarande logo. Du kanske ocks� vill skapa din egen logo genom att anv�nda ditt eget fotoredigeringspaket och v�lj sedan 'ladda upp min egen logo' f�r att l�gga till den p� din webbsajt.",
		"32a" => "Metataggfunktionen till�ter dig att redigera alla metataggar f�r webbsajten som genererats av mjukvaran. Du kan l�gga till din egen titel, nyckelord och beskrivningar f�r var och en av sidorna p� din webbsajt. ",	
		"33a" => "Spr�khanteringsverktyget till�ter dig att ta bort vilket spr�k som helst fr�n webbsajten som du inte vill anv�nda och du kan ocks� l�gga till ditt eget spr�kpaket.",
		"34a" => "Eposthanteringsverktyget till�ter dig att skapa ditt eget system och nyhetsbrev f�r att ge din webbsajt en unik personlig k�nsla.",	
		"35a" => "Introduktion till epostmallar",		
		"36a" => "Introduktion till epostrapporter",
		"37a" => "Introduktion till skicka nyhetsbrev",
		"38a" => "Introduktion till epostp�minnelser",
		"39a" => "Introduktion till nedladdning av epostadresser",
		"40a" => "Introduktion till medlemskapspaket",
		"41a" => "Introduktion till betalningsportar",
		"42a" => "Introduktion till faktureringshistorik f�r medlemskap",
		"43a" => "Introduktion till faktureringshistorik f�r affiliates",
		"44a" => "Introduktion till visningsval",
		"45a" => "Introduktion till visningsinst�llningar",
		"46a" => "Introduktion till systemstigar",
		"47a" => "Introduktion till vattenst�mpel",
		"48a" => "Introduktion till s�k f�lt",
		"50a" => "Introduktion till evenemangkalender",
		"51a" => "Introduktion till webbsajtenk�t",
		"52a" => "Introduktion till webbsajtforum",
		"53a" => "Introduktion till chatrum",
		"54a" => "Introduktion till webbsajtFAQ",
		"55a" => "Introduktion till ordfilter",
		"56a" => "Introduktion till nyheter/artiklar",
		"57a" => "Introduktion till grupper",
);

$admin_login = array(

	"1" => "Logga in till adminomr�det",
	"2" => "Gl�mt ditt l�senord? Inga problem, skriv in din epostadress nedan och vi kommer att skicka ett nytt till dig.",
	"3" => "Epostadress",
	"4" => "Skriv nedan",
	"5" => "�terst�ll l�senord",
	"6" => "Skriv in dina uppgifter nedan f�r att logga in.",
	"7" => "Anv�ndarnamn",
	"8" => "L�senord",	
	"9" => "Licens",	
	"10" => "Spr�k",
	"11" => "Logga in",
	"12" => "Loggad IP �r",	
	"13" => "Gl�mt l�senord",	
);

// EXTRA BITS

$admin_members_extra = array(

	"1" => "Belyst profil",
	"2" => "Webbsajtmoderator",
	"3" => "Medlemskapspaket",
	"4" => "Skicka uppgraderingsepost",
	"5" => "L�gg till paket�ndring till faktureringssystem ",
	"6" => "SMS Nummer",
	"7" => "SMS Krediter",
	"8" => "Ange kontostatus till",	
	
	"9" => "Klicka i rutan f�r att redigera l�senordet.",	
	"10" => "Belysta medlemmar har en annorlunda bakgrund i s�kresultaten.",
	"11" => "Detta ger medlemmen tillg�ng att hantera din webbsajt som moderator.",
	
	"12" => "v�lkomstsida f�r affiliates",	
	"13" => "Visningssida f�r bannerkod",	
	"14" => "Betalningssida f�r affiliates",	
	"15" => "Sammanfattningssida f�r affiliates",
	"16" => "Redigera kontosida f�r affiliates",
	
	"17" => "Importera medlemmar fr�n",	
	
	"18" => "�lder",			
	"19" => "Filvisningar",	
	"20" => "Privat",
	"21" => "Publik",
	
	"22" => "album",		
	"23" => "Vuxet inneh�ll",	
	"24" => "Publikt inneh�ll",	
	
	"25" => "Storlek",		
	"26" => "Flytta filer till vuxenalbum",
	"27" => "Vuxenfilter",

);

$admin_selection = array(

	"1" => "Ja",
	"2" => "Nej",
	
	"3" => "P�",
	"4" => "Av",
);

$admin_plugins = array(

	"1" => "Plugins �kar och expanderar funktionaliteten av eMeeting datingmjukvara. N�r en plugin �r installerad kan du aktivera eller inaktivera den h�r genom att anv�nda menyvalen till v�nster.",
	"2" => "Du kan se och ladda ner nya mjukvaruplugins fr�n kundomr�det p� v�r webbsajt.",
	"3" => "Pluginnamn",
	"4" => "Plugindetaljer",
	"5" => "Senast uppdaterad",
	"6" => "Status",

);
$admin_pop_welcome = array(

	"1" => "V�lkommen tillbaka",
	"2" => "nedan �r en snabb �versikt �ver medlemsregistreringar och webbsajtsprestation f�r dagen.",
	"3" => "Nya medlemmar idag",
	"4" => "Filer att godk�nna",
	"5" => "<strong>Kom ih�g</strong> Om du inte vill f� dessa v�lkomstmeddelanden n�r du loggar in till adminomr�det kan du st�nga av dem n�r som helst genom att �ndra dina adminval.",
	"6" => "St�ng f�nster",

);
$admin_pop_chmod = array(

	"1" => "Tillst�ndsfel f�r fil",
	"2" => "Filerna p� denna sida kan inte modifieras",
	"3" => "f�ljande filer/kataloger beh�ver ha 'skriv' till�telse angivna innan du kan redigera dem. Om du k�r med en Linux eller Unix v�rd kan du anv�nda ditt FTP-program och anv�nda 'CHMOD' ('�ndringsl�ge') funktionen f�r att ge skrivtillst�nd. Om din v�rd k�r Windows m�ste du kontakta dem om att s�tta upp tillst�nd f�r dessa filer/mappar.",
	"4" => "Filerna som kr�ver CHMOD 777 �r",
	"5" => "St�ng f�nster",

);
$admin_pop_demo = array(

	"1" => "Demol�ge p�",
	"2" => "�ndringar av systemet kommer INTE att sparas i demol�ge",
	"3" => "Dina tillg�ngsinst�llningar f�r systemet har angetts till 'demol�ge' vilket inneb�r att tillg�ng till massor av funktioner inom adminomr�det kommer att vara begr�nsad till 'bara l�sa'.",
	"4" => "Du kan surfa runt i adminomr�det som vanligt men �ndringar du g�r kommer inte att sparas under den h�r tiden.",
	"5" => "<strong>Kom ih�g</strong> Om du vill ta bort demol�gesbegr�nsningen p� ditt konto v�nligen kontakta din systemadministration f�r mer information.",
	"6" => "St�ng f�nster",
);

$admin_pop_import = array(

	"1" => "Resultat av databas�verf�ring",
	"2" => "medlemmar importerades framg�ngsrikt!!",
	"3" => "medlemmar importerades framg�ngsrikt fr�n",
	"4" => "mjukvara. V�nligen f�lj instruktionerna nedan f�r att se till att dina medlemsbilder uppdateras korrekt.",
	"5" => "eMeeting bildmappens v�gar finns nedanf�r, du m�ste kopiera bilderna fr�n gamla webbsajten till de nya v�garna nedanf�r;",
	"6" => "St�ng f�nster",
);

$admin_loading= array(

	"1" => "Optimera databastabeller",
	"2" => "V�nligen v�nta",

);
$admin_menu_help= array(
"1" => "Snabbhj�lpsguide",
);

$admin_settings_extra = array(

	"1" => "Visa s�ksida",
	"2" => "Visa kontaktsida",
	"3" => "Visa rundturssida",
	"4" => "Visa FAQ-sida",
	"5" => "Visa evenemang",
	"6" => "Visa grupper",
	"7" => "Visa forum",
	"8" => "Visa matchningar",	
	"9" => "Visa n�tverk",	
	"10" => "Visa affiliatesystem",
	"11" => "Visa SMS / Textmeddelande varningssystem",
	
	"12" => "Visa bloggar",	
	"13" => "Visa chatrum",	
	"14" => "Visa Instant Messenger",	
	"15" => "Visa verifikationsbild f�r registrering",
	"16" => "Visa Postkodss�kning f�r Storbritannien",
	"17" => "Visa ZIP-kodss�kning f�r USA",
	"18" => "Visa MSN/Yahoo Integration",
	
	"19" => "Standardmedlemskapspaket",
		"20" => "Detta �r det medlemskapspaket som medlemmar registreras till som standard",
	"21" => "Medlemmar m�ste ladda upp en bild f�r att g� med",
		"22" => "Detta kommer att avg�ra om medlemmar till�ts att hoppa �ver valet att ladda upp en bild under registreringen.",	
	"23" => "FRITT L�GE",
		"24" => "Ange 'ja' om du vill att alla funktioner p� din webbsajt ska vara tillg�ngliga f�r alla.",
	"25" => "UNDERH�LLSL�GE",
		"26" => "Detta kommer att stoppa all tillg�ng till din webbsajt f�r medlemmar och icke medlemmar och till�ta enbart admins som har loggat in i adminomr�det att anv�nda sajten.",
		
	"27" => "Antal s�kresultat per sida",
		"28" => "V�lj antal profiler som du vill ska visas per sida",		
	"29" => "Antal matchande resultat p� �versiktssida",	
		"30" => "V�lj antal profiler som du vill ska visas per sida.",
		
	"31" => "Aktiveringskoder med epost",
		"32" => "Medlemmar kommer att skickas en aktiveringskod till deras epost som m�ste valideras innan de kan logga in.",
	"33" => "Godk�nn medlemmar manuellt",
	"34" => "Ange 'ja' eller 'nej' beroende p� om du vill verifiera medlemskonton manuellt innan de kan logga in.",
	"35" => "Godk�nn filer manuellt",
		"36" => "Ange 'ja' eller 'nej' beroende p� om du vill verifiera filer manuellt f�re visning",
	"37" => "Godk�nn videoinspelningar manuellt",
		"38" => "Ange 'ja' eller 'nej' beroende p� om du vill verifiera medlemmars s�ndningar manuellt (video chat feeds).",
		
	"39" => "Visa videoh�lsningsinspelaren",
	"40" => "Detta g�r det m�jligt f�r medlemmar att spela in sitt eget videomeddelande till sin profil. Du m�ste skriva in din flash video RMS uppkopplingsserie nedanf�r.",
	"41" => "Flash RMS uppkopplingsserie",
		"42" => "Du beh�ver ett flash v�rdkonto f�r att anv�nda detta",
	"43" => "Visa datumformat",
		"44" => "V�lj det datumformat som du vill ska visas p� din webbsajt",
	"45" => "Till�t profil/filkommentarer",
		"46" => "Tillg�ngligg�r detta val om du vill att medlemmar ska kunna posta kommentarer p� profiler och filer.",
	"47" => "Visa chat och IM i separat f�nster",
	
	"48" => "Tillg�ngligg�r detta val om du vill att chatrum och IM popup ska �ppnas i ett nytt f�nster.",
	
	"49" => "S�kmotorv�nligt?",
		"50" => "Tillg�ngligg�r detta val om du anv�nder linux eller unix v�rdkonto och anv�nder standard .htaccess fil",
	"51" => "S�k blanka foton",
		"52" => "Vill du att medlemmar som inte har lagt till ett foto ska visas i s�kresultaten?.",
	"53" => "Visa flaggbilder",
		"54" => "Ange 'ja' eller 'nej' om du vill att spr�kflaggorna ska visas p� din webbsajt.",
	"55" => "Affiliate valuta",	
	"56" => "Anv�nd HTML-editor",	
	"57" => "Ange 'ja' eller 'nej' beroende p� om du vill verifiera filer manuellt f�re visning",

	"58" => "Visa artikelsida",

);

$admin_billing_extra = array(

	"1" => "Ange 'ja' om du vill att alla egenskaper p� din webbsajt ska vara tillg�ngliga f�r alla.",
	
	"2" => "Pakettyp",
	"3" => "Medlemskapspaket",
	"4" => "SMS-paket",
	"5" => "V�lj ja om du vill skapa ett paket enbart f�r SMS och till�ta detta paket att anv�ndas f�r att k�pa fler SMS-krediter p� din webbsajt.",
	"6" => "Paketnamn",
		"7" => "Skriv in ett namn f�r detta paket, detta kommer att visas p� din anm�lningssida.",
	"8" => "Beskrivning",	
	"9" => "Pris",	
	"10" => "Hur mycket vill du ta betalt f�r medlemmar som v�ljer detta paket? Notera. Skriv inte in n�gra valutasymboler",
	"11" => "Visa valutakod",
	
	"12" => "Detta �r valutakoden som kommer att visas p� din webbsajt, detta anv�nds INTE f�r din betalningsvaluta, detta beh�ver st�llas in i dina betalningsinst�llningar.",	
	"13" => "Anm�lan",	
	"14" => "V�lj ja om du skulle vilja att detta var en �terkommande betalning.",	
	"15" => "Uppgradera period",
	
	"16" => "Dag",
	"17" => "Vecka",
	"18" => "M�nad",
		"18a" => "Obegr�nsad",
	"19" => "Max antal meddelanden (dagligen)",
		"20" => "Detta �r max antal meddelanden som en medlem kan skicka per dag.",
	"21" => "Max antal blinkningar",
		"22" => "Max antal blinkningar som en medlem med detta paket kan skicka varje dag.",	
	"23" => "Max antal filuppladdningar",
		"24" => "Max antal filer en medlem kan ladda upp.",
	"25" => "Paket ikonl�nk",
		"26" => "Ikonl�nken till paketet m�ste vara en l�nk till en bild p� din webbsajt. Rekommenderad storlek: 28px x 90px.",
		
	"27" => "Utvald medlem",
		"28" => "V�lj ja om du skulle vilja att medlemmarnas visningsbild ocks� visas p� framsidan av din webbsajt.",		
	"29" => "Belysta",	
		"30" => "V�lj ja om du skulle vilja att medlemmar med detta paket ska ha en belyst bakgrund i s�kresultaten.",
		
	"31" => "Se vuxenbilder",
		"32" => "V�lj ja om du vill att medlemmarna med det h�r paketet ska kunna se medlemmars vuxenbilder.",
	"33" => "SMS-krediter",
	"34" => "Detta �r antalet SMS-krediter som l�ggs till medlemmarnas konto n�r de uppgraderar till detta paket. Detta kommer att l�ggas till deras nuvarande summa om de redan har krediter.",
	"35" => "Synbart med uppgraderingspaket"

);

$admin_mainten_extra = array(

	"1" => "L�nk",
	"2" => "Skriv bara in en l�nk om du vill l�nka till en extern webbsajt",
	"3" => "RSS Nyhetsfl�desinformation",
	
	"4" => "Kategori",
	"5" => "Visningar",
	"6" => "Filmtext",
	"7" => "Spr�k",
	"8" => "Privat grupp",
		
	"9" => "�ndra forumtavla",	
	"10" => "V�lj forumtavla",
	"11" => "Standardforum",
	
	"12" => "Du anv�nder f�r n�rvarande en tredje parts forum. V�nligen logga in p� deras adminomr�de f�r att hantera deras forum.",	
	"13" => "L�senord"
);

$admin_set_extra1 = array(

	"1" => "Till�t foto/bilduppladdningar",
	"2" => "Till�t videouppladdningar",
	"3" => "Till�t musikuppladdningar",	
	"4" => "Till�t YouTube uppladdningar",	
);

$admin_alerts = array(

	"1" => "Varningar",
	"2" => "nya bes�kare",
	"3" => "nya medlemmar",	
	"4" => "icke godk�nda medlemmar",	
	"5" => "icke godk�nda filer",
	"6" => "nya uppgraderingar",	
);

$lang_members_nn = array(

	"0" => "Medlemsmissbruk�vervakning",
	"1" => "Anv�ndarnamn eller ID",
	"2" => "Ingen chathistorik hittades",	
);

$members_opts = array(

	"1" => "Redigera profil",
	"2" => "Filuppladdningar",
	"3" => "Faktureringshistorik",	
	"4" => "Skicka epostmeddelande",	
	"5" => "Skicka meddelande",
	"6" => "Foruminl�gg",
	"7" => "Meddelandemissbruk",	
);
?>