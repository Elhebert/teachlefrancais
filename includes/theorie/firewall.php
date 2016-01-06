<div id="content">
	<div class="content">
		<ul class="article">
			<li>
				<fieldset>
					<legend class="ref">Firewall et sécurité.</legend>
						<img style="margin-left: 30px;margin-right:0; float: right; border: 1px solid" src="includes/images/theorie/serv-firewall.jpg" alt="serveur" width="200px">
						Un <b>pare-feu</b> (appelé aussi coupe-feu, garde-barrière ou firewall en anglais), est un système permettant de protéger un ordinateur ou un réseau d'ordinateurs des 
						intrusions provenant d'un réseau tiers (notamment internet). Le pare-feu est un système permettant de filtrer les paquets de données échangés avec le réseau, il 
						s'agit ainsi d'une passerelle filtrante comportant au minimum les interfaces réseau suivantes :<br>
						* une interface pour le réseau à protéger (réseau interne)<br>
						* une interface pour le réseau externe<br>
						<br>
						Le système firewall est un système logiciel, reposant parfois sur un matériel réseau dédié, constituant un intermédiaire entre le réseau local (ou la machine 
						locale) et un ou plusieurs réseaux externes. Il est possible de mettre un système pare-feu sur n'importe quelle machine et avec n'importe quel système pourvu que :<br>
						* La machine soit suffisamment puissante pour traiter le trafic<br>
						* Le système soit sécurisé<br>
						Aucun autre service que le service de filtrage de paquets ne fonctionne sur le serveur.<br>
						<br>
						Dans le cas où le système pare-feu est fourni dans une boîte noire « clé en main », on utilise le terme d'« appliance ». 
						<br>
						<img style="border: 1px solid" src="includes/images/theorie/firewall.png" alt="serveur" width="200px">
						Un système pare-feu contient un ensemble de règles prédéfinies permettant :
						* D'autoriser la connexion (allow)<br>
						* De bloquer la connexion (deny)<br>
						* De rejeter la demande de connexion sans avertir l'émetteur (drop)<br>
						<br>
						L'ensemble de ces règles permet de mettre en oeuvre une méthode de filtrage dépendant de la politique de sécurité adoptée par l'entité. On distingue 
						habituellement deux types de politiques de sécurité permettant :
						* soit d'autoriser uniquement les communications ayant été explicitement autorisées :
						* soit d'empêcher les échanges qui ont été explicitement interdits.
						<br>
						La première méthode est sans nul doute la plus sûre, mais elle impose toutefois une définition précise et contraignante des besoins en communication. 
						<br>
						Dans le cas où la zone protégée se limite à l'ordinateur sur lequel le firewall est installé, on parle de firewall personnel (pare-feu personnel). 
						<br>
						<br>
						<img style="margin-left: 30px;margin-right:0; float: right; border: 1px solid" src="includes/images/theorie/securité.jpg" alt="serveur" width="150px">
						Ainsi, un firewall personnel permet de contrôler l'accès au réseau des applications installées sur la machine, et notamment empêcher les attaques du type cheval 
						de Troie, c'est-à-dire des programmes nuisibles ouvrant une brêèhe dans le système afin de permettre une prise en main à distance de la machine par un pirate 
						informatique. Le firewall personnel permet en effet de repérer et d'empêcher l'ouverture non sollicitée de la part d'applications non autorisées à se connecter. 
						<br>
						<br>
						Un système pare-feu n'offre bien évidemment pas une sécurité absolue, bien au contraire. Les firewalls n'offrent une protection que dans la mesure où l'ensemble 
						des communications vers l'extérieur passe systématiquement par leur intermédiaire et qu'ils sont correctement configurés. Ainsi, les accès au réseau extérieur 
						par contournement du firewall sont autant de failles de sécurité. C'est notamment le cas des connexions effectuées à partir du réseau interne à l'aide d'un 
						modem ou de tout moyen de connexion échappant au contrôle du pare-feu. 
						<br>
						De la même manière, l'introduction de supports de stockage provenant de l'extérieur sur des machines internes au réseau ou bien d'ordinateurs portables peut 
						porter fortement préjudice à la politique de sécurité globale. 
						<br>
						Enfin, afin de garantir un niveau de protection maximal, il est nécessaire d'administrer le pare-feu et notamment de surveiller son journal d'activité afin 
						<img style="border: 1px solid" src="includes/images/theorie/protection.jpg" alt="serveur" width="150px">d'être en mesure de détecter les tentatives d'intrusion et les anomalies. Par ailleurs, il est recommandé d'effectuer une veille de sécurité (en s'abonnant aux 
						alertes de sécurité des CERT par exemple) afin de modifier le paramétrage de son dispositif en fonction de la publication des alertes. 
						<br>
						La mise en place d'un firewall doit donc se faire en accord avec une véritable politique de sécurité.
				</fieldset>
            </li>
			<li>
				<div class="precedent">
					<a href="index.php?page=the&the=info" >&laquo; retour</a>
				</div>
			</li>
        </ul>
    </div>
</div>