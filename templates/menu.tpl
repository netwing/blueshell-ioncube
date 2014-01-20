<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">{$smarty.const.APPLICATION_NAME}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="scadenze.php"><i class="icon-bell"></i> Scadenze</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text"></i> Contratti</b></a>
                <ul class="dropdown-menu">
                    <li><a href="contratti.php">Visualizza</a></li>
                    <li><a href="contratto_nuovo.php">Nuovo</a></li>
                    <li><a href="contratti_in_scadenza.php">In scadenza</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="report_contratti.php">Rapporto generico</a></li>
                    <li><a href="rapporto_annuale.php">Rapporto annuale</a></li>
                    <li><a href="corrispettivi.php">Rapporto corrispettivi</a></li>
                    <li><a href="rendite.php">Rapporto rendite</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="statistiche1.php">Statistica per nazionalità</a></li>
                    <li><a href="statistiche4.php">Statistica per provincia</a></li>
                    <li><a href="statistiche2.php">Statistica presenze per dimensione risorsa</a></li>
                    <li><a href="statistiche3.php">Statistica presenze per tipo di imbarcazione</a></li>
                </ul>
            </li>    

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Anagrafiche</b></a>
                <ul class="dropdown-menu">
                    <li><a href="clienti.php">Visualizza</a></li>
                    <li><a href="cliente_inserimento.php">Nuovo</a></li>
                    <li><a href="nota_inserimento.php">Nota</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="clienti_comunicazioni.php">Comunicazioni</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="clienti_etichette.php">Stampa etichette</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-rocket"></i> Imbarcazioni</b></a>
                <ul class="dropdown-menu">
                    <li><a href="barche.php">Visualizza</a></li>
                    <li><a href="barca_inserimento.php?id=0">Nuova</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="assicurazioni_in_scadenza.php">Assicurazioni in scadenza</a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-anchor"></i> Porto</b></a>
                <ul class="dropdown-menu">
                    <li><a href="posti_barca.php">Posti barca</a></li>
                    <li><a href="pontili.php">Pontili</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="report_presenze.php">Rapporto presenze</a></li>
                    <li><a href="report_arrivi.php">Rapporto arrivi</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-archive"></i> Documenti</b></a>
                <ul class="dropdown-menu">
                    <li><a href="fatture.php">Fatture</a></li>
                    <li><a href="prima_nota.php">Prima nota</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="contratti_scadenze.php">Lettere scadenza contratti</a></li>
                    <li><a href="assicurazioni_scadenze.php">Lettere scadenza assicurazioni</a></li>
                    <li><a href="stampa_spese_condominiali.php">Lettere spese condominiali</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="stampa_gestione_template.php">Gestione template di stampa</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="percentuali.php">Statistiche di gestione</a></li>
                </ul>
            </li>    

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-dollar"></i> Listini</b></a>
                <ul class="dropdown-menu">
                    <li><a href="listini_posti_barca.php">Posti barca</a></li>
                    <li><a href="listini_generici.php">Generici</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="listini_nuovo.php">Nuovo listino</a></li>
                </ul>
            </li>

        </ul>
        <form class="navbar-form navbar-right" role="search" action="cerca.php" method="post">
            <div class="form-group">
                <input name="operatore" type="hidden" value="contiene" />
                <input type="text" class="form-control" placeholder="Cerca" style="width: 80px" name="ricerca" id="ricerca">
                <input type="text" class="form-control" placeholder="P.B." style="width: 50px" name="vai_al_pb" id="vai_al_pb">
            </div>
            <button type="submit" class="btn btn-default">Vai</button>
        </form>
        {*
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            *}
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
