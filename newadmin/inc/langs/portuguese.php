<?php

$admin_charset = '';

ini_set('default_charset', 'iso-8859-1');

$LANG_ = array(
"_language" => "Portuguese",
"_charset" => "iso-8859-1",
);
$GLOBALS['_META'] = $LANG_;

// ADMIN AREA
$admin_layout_header = array(

	"charset" => "iso-8859-1",
	"title" => "�rea de Administra�ao"

);

$admin_layout = array(

	"3" => "Preferencias",
	"4" => "Sair",

);


$admin_layout_page1 = array(

	"" => "Painel de instrumentos",

		"_*" => "Admin painel de instrumentos",
		"_?" => "",

	"members" => "Estat�sticas membros",

		"members_*" => "Estat�sticas membros",
		"members_?" => "O gr�fico abaixo mostra o n�mero de inscri�ao de novos membros ao longo das �ltimas duas semanas.",
		"members_^" => "sub",

	"affiliate" => "Estat�sticas afiliados",

		"affiliate_*" => "Estat�sticas afiliados",
		"affiliate_?" => "O gr�fico abaixo mostra o n�mero de inscri�ao de novos afiliados ao longo das �ltimas duas semanas.",
		"affiliate_^" => "sub",

	"visitor" => "Estat�sticas de visitantes",

		"visitor_*" => "Estat�sticas de visitantes",
		"visitor_?" => "O gr�fico abaixo mostra o n�mero de estat�sticas de web site visitantes registados pelo software em cada dia durante as �ltimas duas semanas.",
		"visitor_^" => "sub",

	"maps" => "Mapas google",

		"maps_*" => "Visitante locais com mapas google",
		"maps_?" => "Esta sec�ao permite ver onde no mundo os seus membros estao a juntar-se a partir de seu site. Isto permite-lhe desenvolver o seu marketing e campanhas publicit�rias de forma mais eficaz, orientando e acompanhando diferentes pa�ses.",


	"adminmsg" => "An�ncios do site",

		"adminmsg_*" => "An�ncios do site",
		"adminmsg_?" => "Digite a sua mensagem na caixa abaixo e cada vez que um membro se registar na sua conta, a mensagem ser� exibida. Isso � �ptimo para mostrar an�ncios de servi�o ou mudan�as no seu site.",

);

$admin_layout_page01 = array(

	"backup" => "DB backup",
 
		"backup_*" => "backup de banco de dados",
		"backup_?" => "Escolha uma ou mais das tabelas abaixo para fazer backup de seu banco de dados. � altamente recomend�vel que voc� use os recursos de backup de banco de dados de hospedagem �rea para garantir que todos os dados s�o recebidos.",
	
	"license" => "Key License",
 
		"license_*" => "Key License",
		"license_?" => "Listados abaixo est�o as chaves de licen�a de s�rie, visite ao editar estes para garantir que eles estejam corretos. Voc� pode encontr�-los em AdvanDate.com na �rea Minha conta."
);

$admin_layout_page02 = array(


	"adminmsg" => "An�ncio do site",
 
		"adminmsg_*" => "An�ncio do site",
		"adminmsg_?" => "Introduza a sua mensagem na caixa abaixo e cada vez que um membro registros em sua conta, a mensagem ser� exibida para eles. Isso � �timo para mostrar an�ncios de servi�os ou altera��es do Web site.",

);

$admin_layout_page2 = array(

	"" => "Membros",

		"_$" => "Metada",
		"_*" => "Administrar membros",


			"edit" => "Detalhes dos membros",

				"edit_*" => "Editar membro",
				"edit_?" => "Utilize as op�oes abaixo para actualizar contas de membros e detalhes do perfil.",
				"edit_^" => "Nenhum",


			"fake" => "Falsos membros",

				"fake_*" => "Gerar falsos membros",
				"fake_?" => "Utilize as op�oes abaixo para gerar falsos membros para o seu site, isso ir� ajudar o seu site parece ter membros ao come�ar. � recomendado que voce use o mesmo endere�o de e-mail para todos os membros falso, caso os deseja localizar e exclu�-los numa data posterior.",
				"fake_^" => "sub",

	"banned" => "Membros banidos",

		"banned_*" => "Membros banidos",
		"banned_?" => "O software foi constru�do com um sistema de detec�ao de hacker que bloqueia automaticamente os membros que estao a tentar cortar o seu site. Abaixo estao todos os membros (e nenhum membro) que fizeram tentativas.",
		"banned_^" => "sub",

	"monitor" => "Monitorizar membros",

		"monitor_*" => "Monitorizar membros",
		"monitor_?" => "De tempo em tempo os membros podem abusar do sistema de mensagens ou o envio de mensagens desagrad�veis ou indesej�veis. Voce pode usar esta ferramenta para visualizar e acompanhar as mensagens dos membros para ajudar a proteger a seguran�a dos outros.",
		"monitor_^" => "sub",

	"import" => "Importar membros",

		"import_*" => "Importa membros de banco de dados ou arquivo CVS",
		"import_?" => "Usando as op�oes abaixo, voce pode importar os membros para o seu site a partir de outra base de dados ou de um backup CVS.",
		"import_^" => "sub",

	"files" => "�lbuns membros",
	"files_*" => "Ficheiros �lbuns dos membros",


	"addfile" => "Upload foto",
	"addfile_*" => "Upload uma foto",
	"addfile_?" => "Rs vezes, um membro ter� dificuldade em fazer upload de uma foto para o seu site. Usando esta sec�ao, voce pode enviar uma foto para o seu membro.",
	"addfile_^" => "sub",


	"affiliate" => "Afiliados do seu Site",

		"affiliate_*" => "Afiliados do seu Site",
		"affiliate_?" => "Usando as op�oes abaixo, voce pode administrar os afiliados do seu site.",

			"addaff" => "Adicionar novo afiliado",

				"addaff_*" => "Adicionar/Editar conta de afiliado",
				"addaff_?" => "Complete todos os campos abaixo para adicionar/editar uma conta de afiliado no seu site.",
				"addaff_^" => "sub",

			"affsettings" => "P�ginas de afiliados",

				"affsettings_*" => "P�gina design afiliados",
				"affsettings_?" => "Utilize as op�oes abaixo para editar o texto das p�ginas dos seus afiliados.",
				"affsettings_^" => "sub",

			"affcom" => "Afiliados comissoes",

				"affcom_*" => "Afiliados comissoes ",
				"affcom_?" => "Aqui voce pode definir a taxa de comissao para os seus afiliados. Isto significa que para cada venda feita por um membro vindo de um site afiliado, ser� gerada uma percentagem da venda total.",
				"affcom_^" => "sub",


			"affban" => "Banners de afiliados",

				"affban_*" => "Banners de afiliados",
				"affban_?" => "Aqui voce pode configurar os banners de an�ncios que serao exibido dentro da conta dos seus afiliados para eles usarem no seu site.",
				"affban_^" => "sub",

);


$admin_layout_page3 = array(



		"" => "Tema galeria",

			"_*" => "Tema galeria",
			"_?" => "Listados abaixo estao os sites modelos que estao actualmente instalados no seu site. Clique na imagem para visualizar instantaneamente ou mudar o modelo do seu site.",


			"color" => "Esquema de cores",

				"color_*" => "Esquema de cores",
				"color_?" => "Usando as op�oes abaixo, voce pode personalizar o esquema de cores do seu site. Se deseja substituir as imagens pelas suas, por favor, use as ferramentas de imagem tema.",
				"color_^" => "sub",

			"logo" => "Log�tipo do seu site",
				"logo_$" => "metade",
				"logo_*" => "Log�tipo do seu site",
				"logo_?" => "Utilize as op�oes para personalizar a aparencia do log�tipo do seu site. Voce pode seleccionar um log�tipo pr�-desenhado ou fazer um upload do seu pr�prio.",
				"logo_^" => "sub",

			"img" => "Tema imagens",
				"img_$" => "metade",
				"img_*" => "Tema imagens",
				"img_?" => "As imagens abaixo sao todas as que estao armazenadas dentro do seu modelo na pasta de imagens. Utilize as op�oes abaixo para substituir as imagens existentes por novas.",
				"img_^" => "sub",

			"text" => "Texto da p�gina inicial",
				"text_$" => "Metade",
				"text_*" => "Texto da p�gina inicial",
				"text_?" => "Os campos abaixo permitem-lhe alterar o texto de boas-vindas na p�gina inicial do seu site. Alguns modelos utilizam diferentes conjuntos de pares de formula�ao de modo que pode precisar de experimentar para descobrir qual � o certo para si.",
				"text_^" => "sub",


			"terms" => "Termos e Condi�oes",
				"terms_$" => "metade",
				"terms_*" => "Termos e Condi�oes do site",
				"terms_?" => "Edite o campo abaixo para personalizar os termos e condi�oes do seu site. Estes sao exibidos na p�gina durante a inscri�ao.",
				"terms_^" => "sub",

			"edit" => "P�ginas e ficheiros",

			"edit_*" => "P�ginas Website",
			"edit_?" => "Escolha a partir das caixas de listagem abaixo para visualizar o conte�do dos arquivos do seu site. � recomendado copiar e colar o c�digo para um editor como FrontPage ou Dreamweaver antes de editar. <b> Por favor tome muito cuidado, as altera�oes sao instant�neas e nao pode ser desfeita. </a>",



				"newpage" => "Criar p�gina",
				"newpage_$" => "metade",
				"newpage_*" => "Criar nova p�gina",
				"newpage_?" => "Criar uma nova p�gina no seu site � f�cil. Basta digitar um t�tulo na caixa de texto abaixo e a sua p�gina ser� criada pronta para edi�ao.",
				"newpage_^" => "sub",


			"meta" => "Tema Meta Tags",
				"meta_$" => "metade",
				"meta_*" => "Editor Meta Tag",
				"meta_?" => "Temos um sofisticado sistema de cria�ao de meta tag incorporadas ao software economizando tempo e dinheiro na cria�ao de milhares de descri�oes de p�ginas. O software ir� gerar automaticamente o t�tulo, meta tags descri�ao e palavra-chave com base no conte�do exibido nas p�ginas.",
				"meta_^" => "sub",




			"menu" => "Barras menu",
				"menu_$" => "metade",
				"menu_*" => "Gestao Barra menu",
				"menu_?" => "Utilize as op�oes abaixo para alterar a ordem das barras de seus membros ou adicionar novos itens de menu. Voce tamb�m pode inserir links externos, tais como http://google.com, um link do menu para outro item de menu se quiser link para outro site ou p�gina do seu site.",
				"menu_^" => "sub",

	"manager" => "Gestao de ficheiros",
		"manager_$" => "metade",
		"manager_*" => "Gestao de ficheiros",
		"manager_?" => "O gestor de ficheiros � muito �til quando quer adicionar ou excluir novos arquivos / conte�do no seu site. Voce pode consultar a sua conta de hospedagem e apagar ficheiros que sao necess�rios.",

			"slider" => "Rodar imagens",
				"slider_$" => "metade",
				"slider_*" => "P�gina principal rodar imagens",
				"slider_?" => "As imagens rotativas, sao as imagens na p�gina principal do seu site. Use as op�oes abaixo para alterar a imagem, descri�ao e links clic�veis.",
				"slider_^" => "sub",

	"languages" => "Ficheiros de idioma",
		"languages_$" => "metade",
		"languages_*" => "Ficheiros de idioma",
		"languages_?" => "Listados abaixo estao todos os arquivos de idioma carregados do seu site. Voce pode excluir qualquer um dos idiomas, marque a caixa para alterar o idioma padrao do site. <b> Note, voce deve sair do painel de administra�ao e do site para ver as altera�oes lingu�sticas</b>",

			"editlanguage" => "Editar ficheiros de idioma",
				"editlanguage_$" => "metade",
				"editlanguage_*" => "Editar ficheiros de idioma",
				"editlanguage_?" => "Tome cuidado ao editar o ficheiro de idioma, certifique-se de manter a mesma sintaxe para evitar os erros do sistema. Apenas inserir o conte�do dentro e depois da seta (=>) . O primeiro valor � usado como uma chave.",
				"editlanguage_^" => "sub",

			"addlanguage" => "Adicionar idioma",
				"addlanguage_$" => "metade",
				"addlanguage_*" => "Adicionar idioma",
				"addlanguage_?" => "Para criar um novo ficheiro de idioma, simplesmente copie um dos existentes e renomeio-o, voce pode entao abrir o ficheiro e editar o seu conte�do.",
				"addlanguage_^" => "sub",



);


$admin_layout_page4 = array(

	"" => "E-mail e boletins",

		"_$" => "metade",
		"_*" => "E-mail e boletins informativos",
		"_?" => "Abaixo est� uma lista de todos os e-mails actualmente armazenados no sistema. Sistema de e-mails sao usados pelo software para enviar e-mails aos membros, quando os eventos acontecem, como durante o registro ou perda de senha. Voce pode personalizar todos os e-mails e criar seus pr�prios utilizando as op�oes abaixo",

			"add" => "Criar um novo e-mail",
				"add_$" => "metade",
				"add_*" => "Adicionar/Editar novo e-mail",
				"add_?" => "Complete o formul�rio abaixo para adicionar/editar o seu novo e-mail, este ser� salvo na pasta modelo e-mail personalizado, para que possa retornar a ela ou envi�-lo a qualquer momento que pretenda.",
				"add_^" => "sub",

	"welcome" => "Bem-vindo E-mail",
		"welcome_$" => "metade",
		"welcome_*" => "Configurar E-mail Bem-vindo",
		"welcome_?" => "Usando as op�oes abaixo, voce pode decidir qual o e-mail / mensagem de texto � enviado para o membro quando eles fazem a sua primeira inscri�ao.",
		"welcome_^" => "sub",

	"template" => "Modelos de e-mail",
		"template_$" => "metade",
		"template_*" => "Modelos de e-mail",
		"template_?" => "Listadas abaixo, est� uma selec�ao de modelo constru�dos no software. Clique em qualquer uma das imagens para abrir e editar o modelo.",
		"template_^" => "sub",

	"export" => "Baixar e-mails",

		"export_$" => "metade",
		"export_*" => "Baixar e-mails",
		"export_?" => "Utilize as op�oes abaixo para baixar todos os seus endere�os de e-mail dos seus membros do banco de dados.",
		"export_^" => "sub",

	"sendnew" => "Enviar boletins",

		"sendnew_$" => "metade",
		"sendnew_*" => "Enviar boletim informativo",
		"sendnew_?" => "Use esta sec�ao para come�ar a enviar boletins informativos para os seus membros. Primeiro, seleccione quais os membros a que quer enviar e qual e-mail.",

	"send" => "Enviar e-mail �nico",

		"send_$" => "metade",
		"send_*" => "Enviar e-mail �nico",
		"send_?" => "Utilize esta op�ao para enviar um �nico e-mail a um membro digitando o endere�o de e-mail abaixo. O e-mail usado para enviar � o mesmo listado na sua conta de administrador.",
		"send_^" => "sub",

	/*"auto" => "Email Scheduler",

		"auto_$" => "half",
		"auto_*" => "Automatic Email Scheduler",
		"auto_?" => "Automatic emails are emails that are sent out by the software on a timely manner such as once a day, week, month etc. You can setup such emails below.",
		"auto_^" => "sub",*/

	"subs" => "E-mail lembretes",

		"subs_$" => "metade",
		"subs_*" => "E-mail lembretes",
		"subs_?" => "Lembretes de e-mail, permite que voce envie e-mails para membros que estejam dentro de um n�mero de X dias para um evento. Ex: a sua adesao a terminar ou nao adicionar uma foto.",
		"subs_^" => "sub",

	"tc" => "Relat�rios de e-mail",
		"tc_$" => "metade",
		"tc_*" => "Relat�rios de e-mail",
		"tc_?" => "Relat�rios e-mail sao gerados quando uma mensagem que cont�m o c�digo de monitoramento � enviado. Eles geram estat�sticas de quantos membros abrem os e-mails que voce envia.",
		"tc_^" => "sub",

			"tracking" => "Monitoramento de e-mail",
				"tracking_$" => "metade",
				"tracking_*" => "C�digo de monitoramento de e-mail",
				"tracking_?" => "O c�digo de monitoramento abaixo (tracking_id) passa a ter uma imagem transparente, que � anexa ao e-mail quando ele � enviado. Se o e-mail for aberto e a imagem nao for bloqueada, o sistema grava que o e-mail foi aberto e gerar um relat�rio de monitoramento para si.",
				"tracking_^" => "sub",



	"SMSsend" => "Enviar SMS",

		"SMSsend_$" => "metade",
		"SMSsend_*" => "Enviar SMS",
		"SMSsend_?" => "Utilize as op�oes abaixo para enviar SMS/Mensagens de texto para os telem�veis dos seus membros.",
);

$admin_layout_page5 = array(

	"" => "N�veis de acesso",

		"_$" => "metade",
		"_*" => "N�veis de acesso",
		"_?" => "Listados abaixo estao todos os pacotes de adesao corrente aplicados ao seu site. Os que estao destacados em verde sao exigidos pelo sistema para o controle de como os visitantes e novos membros sao tratados dando-lhe mais controle sobre o seu site.",

			"epackage" => "Adicionar pacote",
				"epackage_$" => "metade",
				"epackage_*" => "Adicionar/Editar pacote",
				"epackage_?" => "Complete o formul�rio abaixo para adicionar ou actualizar o pacote de adesao para o seu site.",
				"epackage_^" => "sub",

			"packaccess" => "Controle o acesso",
				"packaccess_$" => "completo",
				"packaccess_*" => "Controle o acesso r p�gina",
				"packaccess_?" => "Aqui voce pode controlar o acesso ao site inteiro baseado no pacote de adesao. <b> Nota: Apenas marque a caixa se nao deseja que o membro veja esta p�gina. </b>",
				"packaccess_^" => "sub",

			"upall" => "Transferir membros",
				"upall_$" => "metade",
				"upall_*" => "Transferir membros entre os pacotes",
				"upall_?" => "Utilize esta op�ao � que voce deseja transferir os membros de um n�vel de acesso para outro.",
				"upall_^" => "sub",


	"gateway" => "Gateways de pagamento",

		"gateway_$" => "metade",
		"gateway_*" => "Gateways de pagamento",
		"gateway_?" => "Gateways de pagamento permite-lhe tirar o pagamento de actualiza�ao (upgrades) para os seus membros. Se estiver a executar um site gratuito, pode desligar o sistema de pagamento na �rea de configura�oes.",


			"addgateway" => "Ad gateway",
				"addgateway_$" => "metade",
				"addgateway_*" => "Adic. gateway",
				"addgateway_?" => "O software tem um n�mero de gateways de pagamento j� incorporado ao sistema, seleccione o provedor na lista abaixo para usar no seu site.",
				"addgateway_^" => "sub",


	"billing" => "Facturamento",

		"billing_$" => "metade",
		"billing_*" => "Facturamento",


		"affbilling" => "Hist�rico de factu. da filial",

			"affbilling_$" => "metade",
			"affbilling_*" => "Hist�rico de facturamento da filial",
			"affbilling_^" => "sub",


);

$admin_layout_page6 = array(

	"" => "Banners e publicidade",

		"_$" => "metade",
		"_*" => "Banners e Publicidade",


			"addbanner" => "Adicionar banner",
				"addbanner_$" => "metade",
				"addbanner_*" => "Adicionar banner",
				"addbanner_?" => "Utilize as op�oes abaixo para adicionar um novo banner ao seu site.",
				"addbanner_^" => "sub",


);

$admin_layout_page7 = array(

	"" => "Mostrar configura�oes",

		"_$" => "metade",
		"_*" => "Mostrar configura�oes",
		"_?" => "Use as op�oes abaixo para activar e desactivar funcionalidades do site.",


	"op" => "Mostrar op�oes",

		"op_$" => "metade",
		"op_*" => "Mostrar op�oes",
		"op_?" => "Utilize as op�oes abaixo para personalizar as configura�oes do site.",

		"op1" => "Configurar de pesquisa",

			"op1_$" => "metade",
			"op1_*" => "Mostrar configura�oes de pesquisa",
			"op1_?" => "Use as op�oes abaixo para personalizar a maneira como as p�ginas de pesquisa sao exibidas no seu site.",
			"op1_^" => "sub",

		"op2" => "Configura�ao de membros",

			"op2_$" => "metade",
			"op2_*" => "Configura�ao de membros",
			"op2_?" => "Utilize as op�oes abaixo para personalizar como a configura�ao de membros � exibida.",
			"op2_^" => "sub",

		/*"op3" => "Servidor flash",

			"op3_$" => "metade",
			"op3_*" => "Configura�oes do servidor flash",
			"op3_?" => "Um servidor de flash � usado para armazenar sauda�oes de v�deo do membro, � usado tamb�m dentro do IM e bate-papo para mostrar as c�maras de v�deo.",
			"op3_^" => "sub",*/

		"op4" => "Configura�oes API",

			"op4_$" => "metade",
			"op4_*" => "Configura�oes API",
			"op4_^" => "sub",

		"thumbnails" => "Imagens padrao",

			"thumbnails_$" => "metade",
			"thumbnails_*" => "Imagens padrao",
			"thumbnails_^" => "Listados abaixo estao todas as imagens padrao para quando os membros nao carregar as suas pr�prias fotos.",

	"email" => "Configura�oes e-mail",

		"email_$" => "metade",
		"email_*" => "Configura�oes e-mail",
		"email_?" => "Abaixo est� a lista de eventos do site, voce pode seleccionar quais eventos para o qual o sistema envia um e-mail de notifica�ao. Estas notifica�oes de e-mail serao enviadas para todos os administradores que tem acesso rs configura�oes do sistema.",

	"paths" => "Caminhos Pastas",

		"paths_$" => "metade",
		"paths_*" => "Caminhos Pastas",
		"paths_?" => "Os caminhos das pastas e ficheiros a seguir referem-se aos arquivos e pastas da sua conta de hospedagem. O software ir� automaticamente cria-las durante o processo de instala�ao, no entanto se por algum motivo eles estao incorrectos pode modific�-los abaixo.",

	"watermark" => "Marca d'�gua",

		"watermark_$" => "metade",
		"watermark_*" => "Marca d'�gua",
		"watermark_?" => "Uma marca d'�gua da imagem � uma imagem que � exibida na parte superior das fotos dos membros. Estas sao geralmente o seu log�tipo, a imagem de marca d'�gua deve estar no formato PNG, 8bit.",


);


$admin_layout_page8 = array(

	"" => "Campos site",

		"_$" => "metadw",
		"_*" => "Campos do perfil, registro e pesquisa",
		"_?" => "Listados abaixo estao todos os campos actuais listados em seu site. Voce pode seleccionar para mostrar os campos na p�gina de pesquisa, p�ginas de registo, p�gina de perfil e at� mesmo as p�ginas de correspondencia membro. Pode r�pida e facilmente adicionar novos campos utilizando as op�oes abaixo.",

		"fieldlist_*" => "Lista de itens de caixa", 

		"fieldedit_*" => "Editar Caption", 

		"fieldeditmove_*" => "Mover campo para outro grupo",
		
		"addfields" => "Criar novo campo",

			"addfields_$" => "metade",
			"addfields_*" => "Criar novo campo",
			"addfields_?" => "Use as op�oes abaixo para adicionar um novo campo para o seu site. A �rea � usada para permitir que membros possam preencher as informa�oes sobre si.",
			"addfields_^" => "sub",

		"fieldgroups" => "Gerir grupos",

			"fieldgroups_$" => "metade",
			"fieldgroups_*" => "Gerir campos grupos",
			"fieldgroups_?" => "Grupos sao uma colec�ao de campos que tem um tema comum. Assim, por exemplo, voce pode criar um grupo chamado 'Sobre mim' e dentro do grupo adicionar campos como 'Meu Nome',' Minha Idade', etc <b> Se excluir um grupo com os campos, os campos serao automaticamente transferidos para o pr�ximo grupo.",
			"fieldgroups_^" => "sub",

		"addgroups" => "Criar novo campo",

			"addgroups_$" => "metade",
			"addgroups_*" => "Criar novo campo",
			"addgroups_?" => "Um grupo de campos � uma colec�ao de campos colocados sob um t�tulo do grupo principal. Isto permite-lhe criar lotes de grupos com os campos que estao relacionados com o tema do grupo.",
			"addgroups_^" => "sub",




	"cal" => "Calend�rio de eventos",

		"cal_$" => "metade",
		"cal_*" => "Calend�rio de eventos",
		"cal_?" => "O calend�rio de eventos � exibido no site para os membros poderem criar e visualizar os eventos. Utilize as op�oes abaixo para criar, editar e importar novos eventos.",

		"caladd" => "Adicionar um evento",

			"caladd_$" => "metade",
			"caladd_*" => "Adicionar/Editar evento",
			"caladd_?" => "Preencha os campos abaixo para adicionar/editar um evento.",
			"caladd_^" => "sub",

		"caladdtype" => "Gerir tipos de evento",

			"caladdtype_$" => "metade",
			"caladdtype_*" => "Gerir tipos de evento",
			"caladdtype_?" => "Utilize as op�oes abaixo para criar novos tipos de eventos, � recomendado adicionar uma imagem a cada evento para o seu site ter um aspecto mais profissional.",
			"caladdtype_^" => "sub",

		"importcal" => "Importar eventos",

			"importcal_$" => "metade",
			"importcal_*" => "Pesquisar & importar eventos",
			"importcal_?" => "O software tem um sistema de eventos api. Isso permite que voce procure um banco de dados mundial de eventos locais e internacionais e adicion�-los directamente no o seu site.",
			"importcal_^" => "sub",


	"poll" => "Vota�ao Site",

		"poll_$" => "metade",
		"poll_*" => "Vota�ao site",
		"poll_?" => "Utilize as op�oes abaixo para criar e administrar as vota�oes do seu site",

		"polladd" => "Adicionar vota�ao",

			"polladd_$" => "metade",
			"polladd_*" => "Criar uma nova vota�ao",
			"polladd_?" => "Preencha os campos abaixo para criar uma nova vota�ao para o seu site.",
			"polladd_^" => "sub",



	"forum" => "Web Site F�rum",

		"forum_$" => "metade",
		"forum_*" => "Categorias do f�rum",
		"forum_?" => "Utilize as op�oes abaixo para editar as categorias do f�rum. � recomendado adicionar �cones de foto para cada categoria para seu site ter um aspecto mais profissional.",

		"forumadd" => "Adicionar categoria",

			"forumadd_$" => "metade",
			"forumadd_*" => "Adicionar categoria",
			"forumadd_?" => "Preencha os campos abaixo para adicionar uma nova categoria.",
			"forumadd_^" => "sub",

		"forumchange" => "F�rum de terceiros",

			"forumchange_$" => "metade",
			"forumchange_*" => "Editar f�rum integra�ao",
			"forumchange_?" => "O software tem a capacidade de mudar a base do f�rum, isso significa que voce pode escolher qualquer um dos f�runs abaixo para usar em vez do padrao. Por favor, consulte os manuais de instala�ao para cada placa dos f�rum antes de habilitar esse recurso.",
			"forumchange_^" => "sub",

		"forumpost" => "Editar mensagens",

			"forumpost_$" => "metade",
			"forumpost_*" => "Editar mensagens",
			"forumpost_?" => "Listados abaixo estao todas as mensagens recentes adicionadas pelos seus membros. Use as op�oes abaixo para editar ou apagar t�picos que sao abusivos.",
			"forumpost_^" => "sub",

	"chatrooms" => "Salas de chat",

		"chatrooms_$" => "metade",
		"chatrooms_*" => "Salas de chat",
		"chatrooms_?" => "Utilize as op�oes abaixo para criar novas salas de chat ou editar as j� existentes.",


	"faq" => "Web site FAQ",

		"faq_$" => "half",
		"faq_*" => "Web site FAQ",
		"faq_?" => "As FAQ sao uma �ptima maneira de ajudar os membros a aprenderem mais sobre seu site e responder a quaisquer problemas que possam ter. Crie o seu pr�prio conjunto de FAQ e edite-os usando as op�oes abaixo.",

		"faqadd" => "Adicionar FAQ",

			"faqadd_$" => "metade",
			"faqadd_*" => "Adicionar/Editar FAQ",
			"faqadd_?" => "Preencha os campos abaixo para adicionar ou editar uma entrada de FAQ.",
			"faqadd_^" => "sub",

	"words" => "Filtro de Palavras",

		"words_$" => "metade",
		"words_*" => "Filtro de palavras",
		"words_?" => "O filtro de palavras � aplicado a perfis de membros, mensagens instant�neas e f�rum. Filtra qualquer uma das palavras que voce inserir aqui e substitu�-los com as estrelas (**).",



	"articles" => "Artigos",

		"articles_$" => "metade",
		"articles_*" => "Artigos",
		"articles_?" => "Artigos do site sao uma �ptima maneira de manter os seus membros actualizados com as �ltimas altera�oes ao seu site de not�cias e eventos",


		"articleadd" => "Adicionar um artigo",

			"articleadd_$" => "metade",
			"articleadd_*" => "Criar um artigo",
			"articleadd_?" => "Preencha os campos abaixo para adicionar um novo artigo no seu site.",
			"articleadd_^" => "sub",

		"articlerss" => "Importar Artigos RSS",

			"articlerss_$" => "metade",
			"articlerss_*" => "Importar artigos RSS",
			"articlerss_?" => "Os links RSS podem ser usado para importar artigos RSS directamente para uma das categorias que criou. Assim, por exemplo, voce pode querer criar uma categoria 'News' e digite o feed RSS de um site de not�cias. O software ir� extrair todos os artigos de RSS e adicion�-los ao seu site.",
			"articlerss_^" => "sub",

		"articlecats" => "Categorias do artigo",

			"articlecats_$" => "metade",
			"articlecats_*" => "Categorias do artigo",
			"articlecats_?" => "Use as op�oes abaixo para criar categorias de artigo para o seu site.",
			"articlecats_^" => "sub",


	"groups" => "Grupos da comunidade",

		"groups_$" => "metade",
		"groups_*" => "Grupos da comunidade",
		"groups_?" => "Utilize as op�oes abaixo para criar e administrar os grupos da comunidade  do seu site.",


	"class" => "An�ncios classificados",

		"class_$" => "metade",
		"class_*" => "An�ncios classificados",
		"class_?" => "Listados abaixo estao todos os an�ncios classificados criados pelos seus membros.",


		"addclass" => "Adicionar classificados",

			"addclass_$" => "metade",
			"addclass_*" => "Adicionar/Editar classificado",
			"addclass_?" => "Use as op�oes abaixo para adicionar/editar os an�ncios do seu site.",
			"addclass_^" => "sub",

		"addclasscat" => "Gerir as categorias",

			"addclasscat_$" => "metade",
			"addclasscat_*" => "Gerir as categorias",
			"addclasscat_?" => "Utilize as op�oes abaixo para administrar as categorias dos classificados. � recomendado adicionar um �cone para cada categoria, assim o seu site ganha um aspecto mais profissional.",
			"addclasscat_^" => "sub",

	"games" => "Jogos",

		"games_$" => "metade",
		"games_*" => "Jogos",
		"games_?" => "Listados abaixo estao todos os jogos instalados actualmente no seu site. Consulte o manual para obter mais detalhes sobre a instala�ao de novos jogos",

	"gamesinstall" => "Instalar Jogo",

		"gamesinstall_$" => "metade",
		"gamesinstall_*" => "Instalar jogo",
		"gamesinstall_?" => "Seleccione os jogos abaixo que deseja instalar. Se voce quiser adicionar novos jogos para o seu site basta carregar o jogo arquivos tar para o local da pasta do jogo: inc/exe/Jogos/tar/. <b> Consulte o manual para obter mais detalhes sobre a instala�ao de novos jogos </ b>",
		"gamesinstall_^" => "sub",


);


$admin_layout_page9 = array(

	"" => "Administradores",

		"_$" => "metade",
		"_*" => "Administradores e moderadores",
		"_?" => "Listados abaixo estao todos os administradores e moderadores nao incluindo o super usu�rio. Para adicionar moderadores novos, pode usar a p�gina de pesquisa de membros e clicar no �cone de moderador ao lado do nome.",


	"pref" => "Preferencias Admin",

		"pref_$" => "metade",
		"pref_*" => "Preferencias Admin",
		"pref_?" => "Utilize as op�oes abaixo para personalizar as preferencias dos administradores.",

	"manage" => "Gerir moderadores",

		"manage_$" => "metade",
		"manage_*" => "Gerir moderadores",
		"manage_?" => "Um moderador pode ter duas fun�oes, pode ser um moderador do site que permite o acesso a moderar o site principal apenas, ou voce pode fornece-los com os seus dados de login admin para que ele possa fazer o login para a �rea de administrativa e use as ferramentas de administrador.",
		"manage_^" => "sub",

	"email" => "Admin E-mails",

		"email_$" => "metade",
		"email_*" => "Admin E-mails",
		"email_?" => "Listados abaixo estao todos os e-mails enviados para o administrador dos seus membros.",

	"compose" => "Compor E-mail",

		"compose_$" => "metade",
		"compose_*" => "Compor E-mail",
		"compose_?" => "Utilize as op�oes abaixo para criar uma nova mensagem para enviar a um membro.",
		"compose_^" => "sub",

	"super" => "Super membro login",

		"super_$" => "metade",
		"super_*" => "Detalhes super membro login",
		"super_?" => "Por favor, tome cuidado ao editar os detalhes da conta abaixo, esta � a conta de super usu�rio e deve se certificar que a senha � mantida em segredo dos outros momentos.",
		"super_^" => "sub",
);

$admin_layout_page10 = array(

	"" => "Atualizar sotf.",

		"_$" => "metade",
		"_*" => "Atualizar sotf.",
		"_?" => "Listadas abaixo est� a versao actual do software em execu�ao, compare com a versao mais recente dispon�vel. Se sua versao � mais antiga, por favor contacte o seu fornecedor para as �ltimas actualiza�oes.",

	"backup" => "Backup base de dados",

		"backup_$" => "metade",
		"backup_*" => "Backup base de dados",
		"backup_?" => "Seleccione um ou mais quadros abaixo para backup do banco de dados. � altamente recomendado que voce use o backup do banco de dados fornecidos pela empresa de hospedagem.",


	"license" => "Chaves / licen�a",

		"license_$" => "metade",
		"license_*" => "Chaves / licen�a",
		"license_?" => "Listadas abaixo estao as chaves de licen�a do software, por favor tenha aten�ao que elas estejam correctas.",

	"sms" => "SMS Cr�ditos",

		"sms_$" => "metade",
		"sms_*" => "SMS Cr�ditos",
		"sms_?" => "Listadas abaixo � a quantidade actual total de cr�ditos de SMS deixados na sua conta.",

);

$admin_layout_page11 = array(

	"" => "Software Plugins",

		"_$" => "metade",
		"_*" => "Software plugins",
		"_?" => "Plugins adicionam funcionalidades extra ao software. Uma vez que o plugin � instalado, voce pode activ�-lo ou desactiv�-lo aqui, usando as op�oes do menu r esquerda.",

);


$admin_layout_nav = array(

	"1" => "Pain. Instrumentos",
		"1a" => "Estat�sticas membros",
		"1b" => "Estat�sticas afiliados",
		"1c" => "Estat�sticas de visitantes",
		"1d" => "Locais dos visitantes ",
	"2" => "Membros",
		"2a" => "Gerir membros",
		"2b" => "Gerir afiliados",
		"2c" => "Membros banidos",
		"2d" => "Membros ficheiros",
		"2e" => "Importar membros",
	"3" => "Design",
		"3a" => "Tema",
		"3b" => "Editar tema",
		"3c" => "Gerir imagens do tema",
		"3d" => "Editar logo",
		"3e" => "Meta tags",
		"3f" => "Idiomas",
		"3g" => "Reda�ao da p�gina",
		"3h" => "Gerir ficheiros",
		"3i" => "Menu baras",
	"4" => "E-mail",
		"4a" => "Gerir e-mails",
		"4b" => "E-mail modelos",
		"4c" => "Relat�rios de e-mail",
		"4d" => "Enviar e-mail �nico",
		"4e" => "E-mail lembretes",
		"4f" => "Baixar e-mails",
		"4g" => "Enviar boletins informativos",
	"5" => "Faturamento",
		"5a" => "Gerir pacotes",
		"5b" => "Gateways de pagamento",
		"5c" => "Hist�rico de faturamento",
		"5d" => "Hist�rico de faturamento da afiliado",
	"6" => "Configura�oes",
		"6a" => "Op�oes de exibi�ao",
		"6b" => "Configura�oes de exibi�ao",
		"6c" => "Caminhos sistema",
		"6d" => "Marca d'�gua fotos",
	"7" => "Conte�do",
		"7a" => "Campos de pesquisa",
		"7b" => "Calend�rio de eventos",
		"7c" => "Web site vota�ao",
		"7d" => "Web site f�rum",
		"7e" => "Salas de chat",
		"7f" => "FAQ",
		"7g" => "Filtros de palavras",
		"7h" => "Artigos/Not�cias",
		"7i" => "Grupos",
	"8" => "Promo�oes",
		"8a" => "Banners",
	"9" => "Plugins",
		"9a" => "",
	"10" => "Gerir moderadores",
		"10a" => "Gerir moderadores",
		"10b" => "Super membro",
	"11" => "Manuten�ao",
		"11a" => "Sistema backup",
		"11b" => "Chave de licen�a",
		"11c" => "Atualiza�oes do sistema",
);

// MEMBERS PAGE
$lang_members_code = array(
	"update" => "Sistema atualizado com sucesso",
	"no_update" => "Sistema atualizado no entanto, nao havia nada para apagar!",
	"edit" => "Editar",
);
$GLOBALS['lang_admin_edit'] = " ".$lang_members_code['edit'];

$admin_button_val = array(
	"0" => "Pesquisar",
	"1" => "Seleccionar tudo",
	"2" => "Desseleccionar tudo",
	"3" => "Aprovar",
	"4" => "Suspender",
	"5" => "Apagar",
	"6" => "P�r Membros em destaque",
	"7" => "Op�oes",
	"8" => "Update",
	"9" => "Ponha em destaque",
	"10" => "Apagar destaque",
	"11" => "Update idioma padrao",
	"12" => "Enviar",
	"13" => "Continuar",
	"14" => "P�r activo",
	"15" => "Desabilitar ",
	"16" => "Update 0rdem",
	"17" => "Update campo da p�ginas",
	"18" => "Activado",
);

$admin_table_val = array(
	"1" => "Nome de utilizador",
	"2" => "Genero",
	"3" => "�ltimo login",
	"4" => "Estado",
	"5" => "Pacote",
	"6" => "Updated",
	"7" => "Op�oes",
	"8" => "Data",
	"9" => "Endere�o IP",
	"10" => "Hack string",
	"11" => "Registrado em",
	"12" => "Nome",
	"13" => "E-mail",
	"14" => "Clicks",
	"15" => "Registro",

	"15" => "Comissao paga",

	"16" => "Mensagem",
	"17" => "Tempo",
	"18" => "Nome do ficheiro",
	"19" => "�ltima actuliza�ao (updated)",
	"20" => "Editar",
	"21" => "Padrao",
	"22" => "ID",

	"23" => "Pre�o",
	"24" => "Vis�vel",
	"25" => "Tipo",
	"26" => "Editar acesso",
	"27" => "Activo",

	"28" => "Ver c�digo",
	"29" => "Campos",
	"30" => "Nome da filial",
	"31" => "Total em d�vida",
	"32" => "Estado",

	"33" => "Data da atualiza�ao",
	"34" => "Data da expira�ao",
	"35" => "Forma de pagamento",
	"36" => "Ainda activo",
	"37" => "Password",
	"38" => "�ltimo logged in",

	"39" => "Posi�ao",
	"40" => "Hits",
	"41" => "Activo",
	"42" => "Prever",
	"43" => "T�tulo",
	"44" => "Artigos",
	"45" => "Ordenar",

);

$admin_search_val = array(
	"1" => "Nome de utilizador do membro",
	"2" => "Todos os pacotes",
	"3" => "Todos os generos",
	"4" => "Por p�gina",
	"5" => "Ordenar por",
	"6" => "E-mail",

	"7" => "Qualquer estado",
	"8" => "Membros activos",
	"9" => "Membros suspensos",
	"10" => "Membros nao aprovados",
	"11" => "Membros que pretendam cancelar",
	"12" => "Todas as p�ginas",
);
////////////////////////// MAIN PAGES ////////////////////////////////////
$admin_management = array(

	"1" => "Administrar todos os grupos",
	"2" => "Nome do grupo",
	"3" => "Idioma",
	"4" => "Gerir t�picos",
	"5" => "Gerir categorias",
	"6" => "Grupo nome da categoria",
	"7" => "Gerir as categorias",
	"8" => "Nome",
	"9" => "Contar",
	"10" => "Adicionar um artigo",
	"11" => "Categoria",
	"12" => "T�tulo da p�gina",
	"13" => "Breve descri�ao",
	"14" => "Adicionar um artigo",
	"15" => "Gerir categorias",
	"16" => "lista de Campos",
	"17" => "Ordem",
	"18" => "Idioma",
	"19" => "Lista de valores",
	"20" => "Novo campo",

	"21" => "T�tulo do campo",
	"22" => "Tipo de campo",
		"23" => "Campo de texto",
		"24" => "Text area",
		"25" => "List box",
		"26" => "�nica check box",
		"27" => "Multipla check box",

	"28" => "Grupo t�tulo",
	"29" => "Incluir durante o registo",
	"30" => "Selecione abaixo",

	"31" => "Adicionar um grupo",
	"32" => "Op�oes de exibi�ao do grupo",
		"34" => "Mostrar a todos os membros",
		"35" => "Mostrar apenas a administradores ",
		"36" => "Mostrar ao administrador e membro (nao no perfil)",
	"37" => "Apenas",
	"38" => "Gerir grupos",
	"39" => "Adicionar evento",
	"40" => "T�tulo do campo",
	"41" => "T�tulo",
	"42" => "Descri�ao do texto",
	"43" => "Tipo de t�tulo",
	"44" => "Pesquisar t�tulo",
	"45" => "T�tulo do perfil",
	"46" => "Voce deve criar um t�tulo para a p�gina de perfil, como 'eu sou um' e outra para a p�gina da pesquisa como 'Eu procuro um'",
	"47" => "T�tulos de campo existentes",
	"48" => "Mover o campo a este grupo",
	"49" => "Membro ID",
	"50" => "Nome do evento",
	"51" => "Descri�ao do evento",
	"52" => "Tipo de evento",
	"53" => "Selecione a categoria",
	"54" => "Selecione o tipo",
	"55" => "Hora do evento",
	"56" => "Deixe em branco para todo os dia",
	"57" => "Data do evento",
	"58" => "Mes",

	"59" => "Dia",
	"60" => "Ano",
	"61" => "Pa�s",
	"62" => "Distrito",
	"63" => "Rua",
	"64" => "Cidade",
	"65" => "Telefone",
	"66" => "E-mail",
	"67" => "Web site",
	"68" => "Evento vis�vel para",
		"69" => "Todos",
		"70" => "Apenas amigos",

	"71" => "Adicionar inqu�rito",
	"72" => "Resultados do inqu�rito",
	"73" => "Nome do inqu�rito",
	"74" => "Resultado",
	"75" => "P�r activo",

	"76" => "Adicionar t�pico ao f�rum",
	"77" => "Administrar mensagens",
	"78" => "T�pico do f�rum",

	"79" => "T�tulo",
	"80" => "Descri�ao",
	"81" => "Mensagens f�rum",
	"82" => "Todas as mensagens",
	"83" => "Hoje",
	"84" => "Esta semana",
	"85" => "Semana passada",
	"86" => "Nome da sala",
	"87" => "Campos de t�tulo existente",
	"88" => "Senha da sala",
	"89" => "Adicionar nova",
	"90" => "Adicionar F.A.Q",

	"91" => "Adicionar filtro de palavra",
	"92" => "Palavra",

	"93" => "Approvado",
	"94" => "T�tulo",
	"95" => "T�tulo do partido",
	"96" => "Idioma",

	"97" => "Prever",
	"98" => "Resultados",
);
$admin_advertising = array(

	"1" => "Banners do site ",
	"2" => "Adicionar banner",
	"3" => "Banners do afiliado",
	"4" => "Adicionar/Editar banners",
	"5" => "Banner tipo",
	"6" => "Banner do site",
	"7" => "Banner do afiliado",
	"8" => "Nome",
	"9" => "Upload banner",
	"10" => "Entrar HTML",
	"11" => "HTML c�digo",
	"12" => "Upload banner",
	"13" => "Banner Link",
	"14" => "Mostrar a",
		"15" => "Todos os membros",
		"16" => "Membros conectados",

	"17" => "P�gina",
	"18" => "Activo",

	"19" => "Posi�ao top",
	"20" => "Posi�ao centro",
	"21" => "Posi�ao esquerda",
	"22" => "Posi�ao inferior",
	"23" => "Deixe em branco para usar link no c�digo do banner",
	"24" => "Banner prever",

);


$admin_maintenance = array(

	"1" => "Em andamento",
	"2" => "Versao mais recente",
	"3" => "SMS cr�ditos",
	"4" => "Resto de cr�ditos de SMS",
	"5" => "Comprar cr�ditos",

);

$admin_admin = array(

	"1" => "Adicionar Admin",
	"2" => "Nome de utilizador",
	"3" => "Senha",
	"4" => "E-mail",

	"5" => "Editar configura�oes Admin",
	"6" => "Nome completo",
	"7" => "Nivel de acesso",
		"8" => "Acesso completo",
		"9" => "Acesso s� membro",
		"10" => "Acesso s� design",
		"11" => "Acesso s� ao e-mail",
		"12" => "Acesso s� ao faturamento",
		"13" => "Acesso s� rs configura�oes",
		"14" => "Acesso s� r administra�ao",
	"15" => "Admin icon",

	"17" => "Alertas e-mail",
	"18" => "Admin alerta noticias",
	"19" => "Transferir todos os membros de",
	"20" => "Para o seguinte pacote",
	"21" => "Editar pacote",
	"22" => "Pacote de acesso",
	"23" => "Adicionar pacote ao item",
	"24" => "Administrar acesso ao pacote",
);

$admin_settings = array(

	"1" => "Mostrar p�ginas",
	"2" => "Activo",
	"3" => "Desactivo",
	"4" => "Caminhos Web",
	"5" => "Caminho servidor",
	"6" => "Caminho thumbnail",
	"7" => "Adicionar campo",
	"8" => "Nome",
	"9" => "Valor",
	"10" => "Tipo",
	"11" => "Administrar campos",
	"12" => "Adicionar gateways",
	"13" => "Sistemas de pagamento",
	"14" => "C�digo gateway de pagamento",
	"15" => "T�tulo",
	"16" => "Pacote de acesso",
	"17" => "Coment�rios",
	"18" => "Transfererir membros",
	"19" => "Transfer todos os membros de",
	"20" => "Para o seguinte pacote",
	"21" => "Editar pacote",
	"22" => "Pacote de acesso",
	"23" => "Adicionar pacote item",
	"24" => "Administrar pacotes de acesso",
);

$admin_billing = array(

	"1" => "Adicionar pacote",
	"2" => "Administrar pacotes de acesso",
	"3" => "Transferir membros pacotes",
	"4" => "O seu site est� actualmente em execu�ao no <b> Modo Livre </ b>, portanto, todos os pacotes de adesao estao desactivados.",
	"5" => "Gostaria desactivar o modo livre e mostrar os pacotes de adesao?",
	"6" => "Desactivar o modo livre",
	"7" => "Adicionar campo",
	"8" => "Nome",
	"9" => "Valor",
	"10" => "Tipo",
	"11" => "Administrar campos",
	"12" => "Adicionar gateways",
	"13" => "Sistema de pagamentos",
	"14" => "C�digo Gateway de pagamento",
	"15" => "T�tulo",
	"16" => "Pacote acesso",
	"17" => "Coment�rios",
	"18" => "Transferir membros",
	"19" => "Transferir todos os membros de",
	"20" => "Para o seguinte pacote",
	"21" => "Editar pacote",
	"22" => "Pacote acesso",
	"23" => "Adicionar artigo ao pacote",
	"24" => "Administrar pacotes de acesso",

	"25" => "Pendente de aprova�ao",
	"26" => "Pagamentos aprovados",
	"27" => "Pagamentos rejeitados",

	"28" => "Todo o hist�rico",
	"29" => "Pagamentos activos",
	"30" => "Pagamentos terminados",
	"31" => "Subscri�oes activas",
	"32" => "Subscri�oes terminadas",
	"33" => "Pacote C�digo de acesso",

);

$admin_email = array(

	"1" => "Sistema de e-mails",
	"2" => "Boletins informativos",
	"3" => "E-mail modelos",
	"4" => "Editor e-mail",
	"5" => "Assunto",
	"6" => "Prever e-mail",
	"7" => "Para e-mail",

	"8" => "Enviar para",
		"9" => "Todos os membros",
		"10" => "Membros com pacotes subscritos",
		"11" => "Activos / Suspensos / Membros nao aprovados",
	"12" => "Para Pacote",
	"13" => "Membro estado",
	"14" => "Selecione boletim informativo",

	"15" => "Criar novo",
	"16" => "Ver os criados personalizados",
	"17" => "E-mail c�digo de monitoramento",
	"18" => "Criar novo",
	"19" => "Ver os criados personalizados",
	"20" => "E-mail c�digo de monitoramento",
		"21" => "Abaixo c�digo HTML",

	"22" => "Resultados de monitoramento de e-mail",
	"23" => "Nao houve nenhum encontrado.",
	"24" => "Selecione relat�rio",

	"25" => "Enviar lembretes para todos os membros que tem entre",
	"26" => "e",
	"27" => "dias",
	"28" => "Dias que deixou de atualizar a sua assinatura",
	"29" => "Selecione o e-mail para enviar:",
	"30" => "Baixar",
	"31" => "Seleccione o pacote",
	"32" => "C�digo de monitoramento",


);

$admin_design = array(

	"1" => "Baixar temas",
	"2" => "Modelo atual",
	"3" => "Use este modelo",
	"4" => "Meta tags da p�gina",
	"5" => "T�tulo da p�gina",
	"6" => "Descri�ao",
	"7" => "Palavras-chave",
	"8" => "P�ginas do Web site",
	"9" => "Conte�do das p�ginas",
	"10" => "P�ginas personalizadas",
	"11" => "Criar p�gina",
	"12" => "Caminho FTP",
	"13" => "Ficheiros do tema",
	"14" => "Conte�do das p�ginas",
	"15" => "Personalizar p�ginas",


	"16" => "Adicionar idioma",
	"17" => "Nome do novo ficheiro",
	"18" => "Selecione o ficheiro para copiar",

	"19" => "Editar idioma",
	"20" => "Personalizar p�ginas",

	"21" => "Fonte",
	"22" => "Fonte tamanho",
	"23" => "Fonte cor",
	"24" => "largura",
	"25" => "altura",
	"26" => "Adicionar texto logo",
	"27" => "Tela Tipo",
		"28" => "Use tela em branco",
		"29" => "Mantenha o design atual",
		"30" => "Upload meu pr�prio fundo/logotipo",

	"31" => "Criar nova p�gina",
	"32" => "Nome da nova p�gina",
		"33" => "Os nomes das p�ginas devem ser muito curtos e s� uma palavra. Ex: Links, artigos, not�cias, f�rums, etc",
	"34" => "Adicionar Tab Menu?",
		"35" => "Nao! Nao crie um Tab Menu",
		"36" => "Sim. Adicione-o r �rea de membros",
		"37" => "Sim. Adicione-o rs p�ginas do site principal, e nao rs p�ginas da �rea de membros.",
			"38" => "Se seleccionado um novo membro tab ser� criado no seu site",
);

$admin_overview = array(

	"1" => "Comunica�ao",
	"2" => "Total de membros",
	"3" => "Esta semana",
	"3a" => "Hoje",
	"4" => "Atividade recentes do site",
	"5" => "Relat�rios do site",

	"6" => "Visitantes do site nas �ltimas duas semanas",
	"7" => "New member signup's in the last 2 weeks",
	"8" => "Estat�sticas membros g�nero",
	"9" => "Estat�sticas membros idade",

	"10" => "Inscri�oes de afiliados nas �ltimos 2 semanas",
	"11" => "Configurar mapa de visitante",
	"12" => "Por favor, insira a sua chave Google API no campo superior.",
	"13" => "� poss�vel comprar uma chave de licen�a na �rea cliente do nosso web site",

	"14" => "Filtrar resultados da pesquisa",
	"15" => "Todos os ficheiros",

);
$admin_members = array(

	"1" => "Todos os membros",
	"2" => "Moderadores",
	"3" => "Activo",
	"4" => "Suspenso",
	"5" => "Nao aprovado",
	"6" => "Deseja cancelar",
	"7" => "Online agora",
	"8" => "Actividade dos membros online",
	"9" => "Editar detalhes do membro",
	"10" => "Adicionar afiliado",
	"11" => "Afiliado banners",
	"12" => "P�ginas do afiliado",
	"13" => "Adicionar afiliado",
	"14" => "Configurar afiliado",
	"15" => "Todos os ficheiros",
	"16" => "Fotos",
	"17" => "V�deos",
	"18" => "Musica",
	"19" => "YouTube",
	"20" => "Nao aprovado",
	"21" => "Destacado",
	"22" => "Upload ficheiro",
	"23" => "Ficheiro",
	"24" => "Tipo",
	"25" => "Nome de utilizador",
	"26" => "T�tulo",
	"27" => "Coment�rios",
	"28" => "P�r predefinido",
	"29" => "Actividade do membros online",
	"30" => "Afiliados assinado por",
	"31" => "Destacado",
	"a5" => "Nome de utilizador",
	"a6" => "Palavra chave",
	"a7" => "Primeiro nome",
	"a8" => "�ltimo nome",
	"a9" => "Nome da empresa",
	"a10" => "Endere�o",
	"a11" => "Rua",
	"a12" => "Cidade",
	"a13" => "Distrito",
	"a14" => "C�digo postal",
	"a15" => "Pa�s",
	"a16" => "Telefone",
	"a17" => "Fax",
	"a18" => "E-mail",
	"a19" => "Web site endere�o",
	"a20" => "Fa�a um cheque em nome de",
);


// HELP FILES
$admin_help = array(

	"a" => "Come�ar agora",
	"b" => "Nao, eu estou bem. Obrigado!",
	"c" => "Continuar",
	"d" => "Fechar janela",


	"1" => "Introdu�ao",
	"2" => "Precisa de ajuda para come�ar?",
	"3" => "Ol�",

	"4" => "Bem-vindos r �rea de administra�ao! Como esta � a primeira vez que entrou na �rea de administra�ao, � recomendado que tome alguns minutos a acompanhar o assistente abaixo para o ajudar a come�ar!",
	"5" => "O nosso assistente vai gui�-lo atrav�s dos passos b�sicos de configura�ao e deix�-lo pronto e a funcionar num instante.",
	"6" => "<strong> (Nota) </ strong> Voce pode revisitar esta p�gina a qualquer momento, clicando no 'guia de ajuda r�pida' sobre as barras de menu r esquerda.",

	"7" => "Primeiros passos",
	"8" => "Bem-vindo r sua �rea de administra�ao!",
	"9" => "Bem vindo r sua conta de administrador",
	"10" => "Este software permite gerenciar todos os diferentes aspectos de seu web site, incluindo membros, seguran�a, e-mail, plugins, e muito mais.",
	"11" => "Este assistente de introdu�ao apresentar-lhe alguns dos conceitos por tr�s da gestao do web site e permite que voce fa�a algumas configura�oes b�sicas, para que assim comesse a trazer tr�fego (visitantes) para o seu site.",
	"12" => "<strong> (Lembre-se) </ strong> A qualquer momento, voce pode fechar essa janela usando o botao de fechar e voltar mais tarde, clicando no 'guia de ajuda r�pida' na barra de menu r esquerda.",

	"13" => "Introdu�ao r sua �rea de administra�ao!",
	"14" => "A �rea de administra�ao do software � 'baseada na web' que significa que voce pode acessar e gerenciar o seu site em qualquer lugar do mundo com uma conexao r internet. Basta apontar o seu browser para:",
	"15" => "e fa�a o login com os seus dados de administrador.",
	"16" => "Clique aqui para marcar este link agora.",

	"17" => "Introdu�ao ao seu painel.",
	"18" => "O painel do software d�-lhe uma visao r�pida do desempenho do seu site, voce pode ler o an�ncio de software, ver o hist�rico de registos, os membros, estat�sticas dos afiliados e mais.",
	"19" => "Todas as informa�oes dos membros sao armazenadas no banco de dados MYSQL chamado:",
	"20" => "Introdu�ao rs estat�sticas do site.",
	"21" => "As estat�sticas dao-lhe uma representa�ao visual do historial de registo dos membros e dos afiliados por um per�odo de duas semanas. Cada vez que um membro ou afiliado se regista ao seu site, a hora e a data � gravada e mostrada nos gr�ficos.",

	"22" => "Introdu�ao aos locais de visitante",
	"23" => "Introdu�ao r gestao de membros",
	"24" => "Introdu�ao r gestao de seus afiliados",
	"25" => "Introdu�ao r gestao de seus membros banidos",
	"26" => "Introdu�ao r gestao de seus ficheiros do membro",
	"27" => "Introdu�ao aos membros importados",
	"28" => "Introdu�ao aos temas do site",
	"29" => "Introdu�ao ao editor do tema",
	"30" => "Introdu�ao ao gestor das imagens do tema",
	"31" => "Introdu�ao ao editor do logo",
	"32" => "Introdu�ao ao meta tags",
	"33" => "Introdu�ao aos idiomas",
	"34" => "Introdu�ao ao gestor de e-mails",
	"35" => "Introdu�ao aos e-mails modelo",
	"36" => "Introdu�ao aos relat�rios de e-mails",
	"37" => "Introdu�ao para enviar boletins informativos",
	"38" => "Introdu�ao aos lembretes de e-mail",
	"39" => "Introdu�ao ao baixar endere�os de e-mail",
	"40" => "Introdu�ao aos pacotes de membros",
	"41" => "Introdu�ao aos pagamento gateways",
	"42" => "Introdu�ao ao historial de facturamento do membro",
	"43" => "Introdu�ao ao historial de facturamento do afiliado",
	"44" => "Introdu�ao rs op�oes de exibi�ao",
	"45" => "Introdu�ao rs configura�oes de exibi�ao",
	"46" => "Introdu�ao aos sistemas de rotas",
	"47" => "Introdu�ao r marca d'�gua",
	"48" => "Introdu�ao aos campos de pesquisa",
	"50" => "Introdu�ao ao Calend�rio de Eventos",
	"51" => "Introdu�ao aos inqu�ritos do site",
	"52" => "Introdu�ao ao f�rum",
	"53" => "Introdu�ao rs salas de chat",
	"54" => "Introdu�ao rs FAQ",
	"55" => "Introdu�ao ao filtro de palavras",
	"56" => "Introdu�ao rs Not�cias / Artigos",
	"57" => "Introdu�ao aos grupos",

		"22a" => "Os mapas dos locais dos visitante, permite-lhe ver num relance de quais pa�ses os seus membros estao a aderir.",
		"23a" => "A ferramenta de gestao membros permite que voce veja todos os membros que se juntaram a seu site. Use as op�oes de pesquisa para filtrar os seus membros, para editar, actualizar e excluir os perfis dos membros.",
		"24a" => "A ferramenta de gestor de afiliados permite-lhe ver de relance todos os seus afiliados. Pode nao s� visualizar, mas tamb�m editar, apagar e aprovar novas inscri�oes.",
		"25a" => "A sec�ao de membros banidos regista todos os membros e nao membros que tentam 'hackar' o seu site. O software suspende automaticamente os membros de verem o seu site prevenindo algum preju�zo.",
		"26a" => "A ferramenta de ficheiros permite-lhe ver e gerir todas as m�sicas, v�deos, fotos, etc dos seus membros. Pode ainda usar a nossa 'cropping tool' para editar e corta as fotos.",
		"27a" => "A ferramenta de importa�ao de membros permite-lhe importar membros de outras aplica�oes. Basta digitar a informa�ao da base de dados do site antigo e ele ser� transferido para o seu novo site.",
		"28a" => "A sec�ao dos temas permite-lhe mudar o modelo e design do seu site na hora! Basta clicar no tema desejado e ele ser� actualizado automaticamente.",
		"29a" => "A ferramenta 'editor de temas' permite-lhe editar as p�ginas do seu site directamente na �rea de administra�ao. Voce tamb�m pode copiar e colar o c�digo do seu editor e col�-lo novamente depois de ter terminado a edi�ao.",
		"30a" => "O gestor de imagens do tema permite-lhe mudar as imagens do tema por outras instantaneamente. As novas imagens serao aplicadas automaticamente.",
		"31a" => "A ferramenta de gestao do log�tipo permite-lhe alterar o design actual do seu log�tipo. Voce pode tamb�m criar um log�tipo usando o seu pr�prio editor e depois usar a ferramenta 'upload - carregar o meu pr�prio'.",
		"32a" => "A ferramenta meta tags permite-lhe editar todas as metas tags das p�ginas do seu site geradas pelo software. Voce pode adicionar o seu pr�prio t�tulo, palavras-chave e descri�oes de cada uma das p�ginas. ",
		"33a" => "A ferramenta de gerir idiomas permite-lhe excluir ou adicionar qualquer idioma no seu site.",
		"34a" => "A ferramenta de gestao de e-mails permite-lhe criar o seu pr�prio boletim informativo, dando-lhe um toque �nico e pessoal ao seu site.",
		"35a" => "Introdu�ao aos modelos de e-mail",
		"36a" => "Introdu�ao aos relat�rios e-mail",
		"37a" => "Introdu�ao ao enviar boletins informativos",
		"38a" => "Introdu�ao aos lembretes e-mai",
		"39a" => "Introdu�ao ao baixar endere�os de e-mail",
		"40a" => "Introdu�ao aos pacotes de membros",
		"41a" => "Introdu�ao aos pagamento Gateways",
		"42a" => "Introdu�ao ao historial de facturamento do membro",
		"43a" => "Introdu�ao ao historial de facturamento do afiliado",
		"44a" => "Introdu�ao rs Op�oes de exibi�ao",
		"45a" => "Introdu�ao rs configura�oes de exibi�ao",
		"46a" => "Introdu�ao aos sistemas de rotas",
		"47a" => "Introdu�ao r marca d'�gua",
		"48a" => "Introdu�ao aos campos de pesquisa",
		"50a" => "Introdu�ao ao calend�rio de eventos",
		"51a" => "Introdu�ao aos inqu�ritos do site",
		"52a" => "Introdu�ao ao f�rum",
		"53a" => "Introdu�ao rs salas de chat",
		"54a" => "Introdu�ao rs FAQ",
		"55a" => "Introdu�ao ao filtro de palavras",
		"56a" => "Introdu�ao rs Not�cias / Artigos",
		"57a" => "Introdu�ao aos grupos",
);

$admin_login = array(

	"1" => "Admin Area Login",
	"2" => "Esqueceu a sua senha? Nao se preocupe, digite o seu endere�o de e-mail abaixo e enviaremos uma nova.",
	"3" => "Endere�o de e-mail",
	"4" => "Texto abaixo",
	"5" => "Reset senha",
	"6" => "Digite seus dados abaixo para login.",
	"7" => "Nome de utilizador",
	"8" => "Senha",
	"9" => "Licen�a",
	"10" => "Idioma",
	"11" => "Login",
	"12" => "IP registrado �",
	"13" => "Esqueci minha senha",
);

// EXTRA BITS

$admin_members_extra = array(

	"1" => "Destaque perfil",
	"2" => "Web site moderador",
	"3" => "Pacote membro",
	"4" => "Enviar e-mail de atualiza�ao(upgrade)",
	"5" => "Adicionar pacote mudar de sistema de faturamento",
	"6" => "SMS n�mero",
	"7" => "SMS creditos",
	"8" => "Definir status da conta para",

	"9" => "Clique na caixa para editar a senha.",
	"10" => "Destaque membros com um fundo diferente na pesquisa.",
	"11" => "Isto d� a acesso a membros a gerir seu site como um moderador.",

	"12" => "afiliados p�gina de boas-vindas",
	"13" => "Mostrar c�digo do banner",
	"14" => "Afiliados p�gina de pagamento",
	"15" => "Afiliado p�gina de resumo",
	"16" => "Afiliado editar p�gina da conta",

	"17" => "Importar membros de",

	"18" => "Idade",
	"19" => "Ficheiros visto",
	"20" => "Privado",
	"21" => "P�blico",

	"22" => "album",
	"23" => "Conte�do adulto",
	"24" => "Conte�do p�blico",

	"25" => "Tamanho",
	"26" => "Mover os ficheiros para �lbuns adulto ",
	"27" => "Ficheiros para adulto",

);

$admin_selection = array(

	"1" => "Sim",
	"2" => "Nao",

	"3" => "Ligado",
	"4" => "Desligado",
);

$admin_plugins = array(

	"1" => "Plugins estende e expande as funcionalidades do software. Uma vez instalado, voce pode activar ou desactivar no menu r esquerda .",
	"2" => "Voce pode ver e baixar novos plugins na �rea de cliente do nosso site.",
	"3" => "Nome do plugin",
	"4" => "Detalhes do plugin",
	"5" => "Ultima actualiza�ao",
	"6" => "Estado",

);
$admin_pop_welcome = array(

	"1" => "Bem-vindo de volta",
	"2" => "Abaixo esta uma visao geral das inscricoes dos membros (logins) e do desempenho do seu site para hoje.",
	"3" => "Membros novos hoje",
	"4" => "Ficheiros para aprovar",
	"5" => "<strong> Lembre-se </strong> Se nao deseja receber estes alertas de boas-vindas quando acessar na area administrativa, pode desliga-los a qualquer momento alterando as suas preferencias de admin.",
	"6" => "Fechar janela",

);
$admin_pop_chmod = array(

	"1" => "Ficheiros de permissao erro",

	"2" => "Os ficheiros desta p�gina nao podem ser modificados",
	"3" => "Os seguintes ficheiros/direct�rios precisam de ter o acesso `write� (escrever) nas suas permissoes antes de os poder editar. Se est� a usar um servidor Linux ou Unix Web host, voce pode usar um programa FTP e mudar o `CHMOD�(`Change Mode�) para alterar as permissoes. Se est� a usar um servidor Windows, precisa de contactar a sua companhia de alojamento e pedir-lhes para alterarem esses ficheiros/direct�rios.",
	"4" => "Os ficheiros/direct�rios que exigem CHMOD 777 sao",
	"5" => "Fechar janela",

);
$admin_pop_demo = array(

	"1" => "Modo demo ligado",
	"2" => "As altera�oes no modo DEMO nao serao salvas",
	"3" => "As configura�oes de acesso ao sistema foram estabelecidas em modo 'DEMO', o que significa que muitos recursos e funcionalidades dentro da �rea de administra�ao serao limitados a'somente leitura'.",
	"4" => "Voce pode navegar normal pela �rea administrativa, no entanto, qualquer altera�ao nao ser� salva.",
	"5" => "<strong> Lembre-se</strong> Se deseja remover a restri�ao sobre o modo de demonstra�ao da sua conta (DEMO), por favor entre em contacto com a administra�ao do sistema para obter mais detalhes.",
	"6" => "Fechar janela",
);

$admin_pop_import = array(

	"1" => "Resultados da transferencia da base de dados",
	"2" => "membros foram importados com sucesso!",
	"3" => "membros foram importados com sucesso de",
	"4" => "software. Por favor, siga as instru�oes abaixo para garantir que as imagens do seus membros sao actualizadas correctamente.",
	"5" => "Os caminhos de pasta das imagens estao abaixo, voce deve copiar as imagens do site antigo para estes os novos caminhos;",
	"6" => "Fechar janela",
);

$admin_loading= array(

	"1" => "A optimizar as tabelas da base de dados",
	"2" => "Por favor espere",

);
$admin_menu_help= array(
"1" => "Guia ajuda r�pida",
);

$admin_settings_extra = array(

	"1" => "Mostrar p�gina de pesquisa",
	"2" => "Mostrar p�gina de contacto",
	"3" => "Mostrar p�gina Tour",
	"4" => "Mostrar p�gina FAQ",
	"5" => "Mostrar eventos",
	"6" => "Mostrar gruposs",
	"7" => "Mostrar f�rum",
	"8" => "Mostrar jogos",
	"9" => "Mostrar rede",
	"10" => "Mostrar sistema de afiliados",
	"11" => "Mostrar SMS / mensagens de texto e alertas do sistema",

	"12" => "Mostrar blogs",
	"13" => "Mostrar salas chat",
	"14" => "Mostrar mensagens instant�neas (chat privado)",
	"15" => "Mostrar a imagem de verifica�ao no registo",
	"16" => "Mostrar o UK c�digo postal na pesquisa ",
	"17" => "Mostrar o UK c�digo postal na pesquisa ",
	"18" => "Mostrar integra�ao MSN/Yahoo",

	"19" => "Pacote por defeito para os membros ",
		"20" => "Este pacote ser� para todos os registos padrao do membros",
	"21" => "Tem de incluir (upload) uma imagem para se registar",
		"22" => "Se activar, os membros tem a permissao para saltar a op�ao de inserir (upload) uma imagem durante o registo.",
	"23" => "MODO GR�TIS",
		"24" => "Defina esta op�ao para 'sim' se quiser que todas as funcionalidades do seu site possam ser acess�veis a todos.",
	"25" => "MODO MANUTEN�AO",
		"26" => "Isto ir� parar todos os acessos ao seu site para os membros e nao membros e permitir que somente o administrador registado tem acesso para ver o site.",

	"27" => "N�mero de resultados de pesquisa por p�gina",
		"28" => "Seleccione o n�mero de perfis a ser exibidos por p�gina",
	"29" => "N�mero de resultados correspondentes revisao geral da p�gina",
		"30" => "Seleccione o n�mero de perfis a serem exibidos por p�gina.",

	"31" => "C�digos de activa�ao de e-mail",
		"32" => "Aos membros ser� enviado um c�digo de activa�ao para seu e-mail que devem ser validados antes que eles possam fazer login (aceder).",
	"33" => "Aprovar membros manualmente",
	"34" => "Defina esta op�ao para 'sim' ou 'nao' dependendo se deseja verificar manualmente as contas de membros antes que eles possam fazer o login.",
	"35" => "Aprovar ficheiros manualmente",
		"36" => "Defina esta op�ao para 'sim' ou 'nao' dependendo se deseja verificar manualmente os ficheiros antes de os exibir",
	"37" => "Aprovar grava�oes de v�deo manualmente",
		"38" => "Defina esta op�ao para 'sim' ou 'nao' dependendo se quiser verificar manualmente membro transmissoes (video chat feeds).",

	"39" => "Mostrar grava�ao de sauda�ao de video",
	"40" => "Isto permite os membros de gravar a sua mensagem de v�deo pr�prio para o seu perfil. Voce deve digitar o seu RMS sequencia flash v�deo abaixo.",
	"41" => "Flash RMS String de conexao",
		"42" => "Voce precisa de ter um servidor flash para usar isto",
	"43" => "Exibi�ao da data ",
		"44" => "Seleccione o formato da exibi�ao da data que deseja para seu site",
	"45" => "Permitir perfil / coment�rios ficheiros",
		"46" => "Ative esta op�ao se deseja que os membros deixem coment�rios sobre os perfis e ficheiros.",
	"47" => "Mostrar IM mensagens instant�neas (chat privado) numa janela separada",

	"48" => "Habilite esta op�ao se voce quiser chat privado e mensagens instant�neas abram numa nova janela.",

	"49" => "Pesquisa amig�vel?",
		"50" => "Habilite esta op�ao se estiver num servidor Linux ou Unix usando o padrao. Htaccess",
	"51" => "Pesquisar fotos em branco",
		"52" => "Quer que os membros que nao tenham fotos apare�am na pesquisa?.",
	"53" => "Mostrar imagens da bandeira",
		"54" => "Definir 'sim' ou 'nao' se deseja ter as bandeiras de idioma exibidas no seu site.",
	"55" => "Afiliados Moeda",
	"56" => "Usar HTML Editor",
	"57" => "Defina esta op�ao para 'sim' ou 'nao' dependendo se deseja verificar manualmente os ficheiros antes de exibir",

	"58" => "Mostrar p�gina de artigos",

);

$admin_billing_extra = array(

	"1" => "Defina esta op�ao para 'sim' se quiser que todas as funcionalidades do seu site sejam acess�veis a todos.",

	"2" => "Pacote tipo",
	"3" => "Pacote membro",
	"4" => "SMS pacote",
	"5" => "Seleccione Sim, se voce deseja criar um pacote SMS que possa a ser usado para comprar cr�ditos adicionais SMS no seu site.",
	"6" => "Nome do pacote",
		"7" => "Digite um nome para este pacote, este ser� exibido na p�gina de subscri�ao.",
	"8" => "Descri�ao",
	"9" => "Pre�o",
	"10" => "Quanto quer cobrar para que os membros inscrevam-se nesse pacote? Note. Nao entre s�mbolos de moeda",
	"11" => "Mostrar C�digo de Moeda",

	"12" => "Este � o c�digo da moeda que ser� exibida no seu site, ele nao � utilizado para a moeda de pagamento, este deve ser fixado nas defini�oes de pagamento.",
	"13" => "Subscri�ao",
	"14" => "Seleccione Sim, se voce gostaria que este pagamento se torne recorrente.",
	"15" => "Per�odo de actualiza�ao (upgrade)",

	"16" => "Dia",
	"17" => "Semana",
	"18" => "Mes",
		"18a" => "Ilimitado",
	"19" => "M�ximo mensagens (dia)",
		"20" => "Este � o n�mero m�ximo de mensagens que os membros podem enviar por dia.",
	"21" => "M�ximos interesses",
		"22" => "O n�mero m�ximo de interesses que um membro com este pacote pode enviar por dia.",
	"23" => "Max Ficheiros m�ximos para upload ",
		"24" => "Ficheiros m�ximos que um membro pode fazer upload.",
	"25" => "Pacote icon link",
		"26" => "O link �cone do pacote deve ser um link para uma imagem do seu site. Recomendando-mos tamanho: 28px x 90px.",

	"27" => "Membro em destaque",
		"28" => "Seleccione Sim, se quiser exibir as fotos destes membros na frente de seu site.",
	"29" => "Destacados",
		"30" => "Seleccione Sim, se gostaria que membros com este pacote fiquem com um fundo em destaque nos resultados da pesquisa.",

	"31" => "Ver imagens adulto",
		"32" => "Seleccione Sim, se quiser que os membros com este pacote possam visualizar as imagens de membros para adultos.",
	"33" => "SMS creditos",
	"34" => "Este � o n�mero de cr�ditos SMS acrescentado para os membros quando eles sao actualizados para este pacote. Este ser� acrescentado ao seu valor actual, se eles j� tiverem cr�ditos.",
	"35" => "Vis�vel na p�gina de upgrade"

);

$admin_mainten_extra = array(

	"1" => "Link",
	"2" => "Apenas insira um link se deseja uma liga�ao para um site externo",
	"3" => "Not�cias RSS feed data",

	"4" => "Categoria",
	"5" => "Vistas",
	"6" => "Legenda",
	"7" => "Idioma",
	"8" => "Grupo privado",

	"9" => "Alterar F�rum",
	"10" => "Seleccionar F�rum",
	"11" => "F�rum padrao",

	"12" => "Voce est� a usar um f�rum de terceiros. Fa�a o login na sua �rea de administra�ao para administrar o seu f�rum",
	"13" => "Palavra chave"
);

$admin_set_extra1 = array(

	"1" => "Permitir Foto/Imagem Uploads",
	"2" => "Permitir V�deo Uploads",
	"3" => "Permitir Musica Uploads",
	"4" => "Permitir YouTube Uploads",
);

$admin_alerts = array(

	"1" => "Alertas",
	"2" => "Novos visitantes",
	"3" => "Novos membros",
	"4" => "Membros nao aprovados",
	"5" => "Ficheiros nao aprovados",
	"6" => "novas atualiza�oes",
);

$lang_members_nn = array(

	"0" => "Monitor de membros com abuso",
	"1" => "Nome de utilizador",
	"2" => "Nenhum hist�rico de Chat encontrados",
);

$members_opts = array(

	"1" => "Editar perfil",
	"2" => "Ficheiros Uploads",
	"3" => "Hist�rico de faturamento",
	"4" => "Enviar E-mail",
	"5" => "Enviar Mensagem",
	"6" => "F�rum mensagens",
	"7" => "Mensagens abusivas",
);

$admin_overview = array(



	"1" => "An�ncio",

	"2" => "Membros totais",

	"3" => "Esta semana",

	"3a" => "Hoje",

	"4" => "Actividade recente do site",

	"5" => "Relat�rios Web site",



	"6" => "Visitantes �nicos nas �ltimas duas semanas",

	"7" => "Novos membros inscritos  nas �ltimas 2 semanas",

	"8" => "Estat�sticas de membros por g�nero",

	"9" => "Estat�sticas de membros por idade",



	"10" => "Novos afiliados registados nas �ltimas 2 semanas",

	"11" => "Visitor Map Settings",

	"12" => "Por favor insira a sua chave Google API no campo acima.",

	"13" => "Voc� pode comprar uma chave de licen�a na �rea do nosso site web",



	"14" => "Resultados da pesquisa",

	"15" => "Todos os ficheiros",

);
?>
