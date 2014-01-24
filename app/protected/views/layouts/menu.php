<?php if (!Yii::app()->user->isGuest): ?>
<nav class="navbar navbar-default" role="navigation" id="topNavbar">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only"><?php echo Yii::t('app', 'Toggle navigation'); ?></span>
            <span class="fa fa-bars"></span>
        </button>
        <a class="navbar-brand" href="index.php">
        <img src="<?php echo Yii::app()->bridge->oldUrl("images/shell.png"); ?>" alt="BlueShell" />
        <span style="font-weight: bold;">Blue</span><span style="font-weight: 200">Shell</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- <i class="fa fa-file-text"></i> --> <?php echo Yii::t('app', 'Contracts'); ?></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/contractType/admin'); ?>"><?php echo Yii::t('app', 'Contracts type'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("contratti.php"); ?>"><?php echo Yii::t('app', 'View contracts'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("contratto_nuovo.php"); ?>"><?php echo Yii::t('app', 'New contract'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("contratti_in_scadenza.php"); ?>"><?php echo Yii::t('app', 'Expiring'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("report_contratti.php"); ?>"><?php echo Yii::t('app', 'Generic report'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("rapporto_annuale.php"); ?>"><?php echo Yii::t('app', 'Annual report'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("corrispettivi.php"); ?>"><?php echo Yii::t('app', 'Fees report'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("rendite.php"); ?>"><?php echo Yii::t('app', 'Income report'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("statistiche1.php"); ?>"><?php echo Yii::t('app', 'Country statistics'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("statistiche4.php"); ?>"><?php echo Yii::t('app', 'Province statistics'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("statistiche2.php"); ?>"><?php echo Yii::t('app', 'Presence for resource dimension'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("statistiche3.php"); ?>"><?php echo Yii::t('app', 'Presence for vector type'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("scadenze.php"); ?>"><?php echo Yii::t('app', 'Deadlines'); ?></a></li>
                </ul>
            </li>    

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="icon-user"></i> --> <?php echo Yii::t('app', 'Clients'); ?></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("clienti.php"); ?>"><?php echo Yii::t('app', 'View clients'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("cliente_inserimento.php"); ?>"><?php echo Yii::t('app', 'New client'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("nota_inserimento.php"); ?>"><?php echo Yii::t('app', 'Notes'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("clienti_comunicazioni.php"); ?>"><?php echo Yii::t('app', 'Communication'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("clienti_etichette.php"); ?>"><?php echo Yii::t('app', 'Label print'); ?></a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="fa fa-rocket"></i> --> <?php echo Yii::t('app', 'Vectors'); ?></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("barche.php"); ?>"><?php echo Yii::t('app', 'View vectors'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("barca_inserimento.php?id=0"); ?>"><?php echo Yii::t('app', 'New vector'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("assicurazioni_in_scadenza.php"); ?>"><?php echo Yii::t('app', 'Expiring insurances'); ?></a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="icon-anchor"></i> --> <?php echo Yii::t('app', 'Port'); ?></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/dimension/admin'); ?>"><?php echo Yii::t('app', 'Dimensions'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("posti_barca.php"); ?>"><?php echo Yii::t('app', 'Resources'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("pontili.php"); ?>"><?php echo Yii::t('app', 'Piers'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("report_presenze.php"); ?>"><?php echo Yii::t('app', 'Presence report'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("report_arrivi.php"); ?>"><?php echo Yii::t('app', 'Arrival report'); ?></a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="icon-user"></i> --> <?php echo Yii::t('app', 'Orders'); ?></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/order/create'); ?>"><?php echo Yii::t('app', 'Add new order'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/order/admin'); ?>"><?php echo Yii::t('app', 'Show orders'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/orderType/admin'); ?>"><?php echo Yii::t('app', 'Order types'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/orderStatus/admin'); ?>"><?php echo Yii::t('app', 'Order status'); ?></a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <i class="icon-archive"></i> --> <?php echo Yii::t('app', 'Documents'); ?></a>
                <ul class="dropdown-menu">
                    <?php /* <li><a href="<?php echo Yii::app()->bridge->oldUrl("fatture.php"); ?>"><?php echo Yii::t('app', 'Invoice'); ?></a></li> */ ?>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/invoice/admin'); ?>"><?php echo Yii::t('app', 'Show invoices'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/invoiceStatus/admin'); ?>"><?php echo Yii::t('app', 'Invoices status'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/invoiceType/admin'); ?>"><?php echo Yii::t('app', 'Invoices types'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("prima_nota.php"); ?>"><?php echo Yii::t('app', 'Petty cash book'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("contratti_scadenze.php"); ?>"><?php echo Yii::t('app', 'Expiring contract letters'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("assicurazioni_scadenze.php"); ?>"><?php echo Yii::t('app', 'Expiring insurance letters'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("stampa_spese_condominiali.php"); ?>"><?php echo Yii::t('app', 'Services charges letters'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/systemTemplate/admin'); ?>"><?php echo Yii::t('app', 'System templates'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("stampa_gestione_template.php"); ?>"><?php echo Yii::t('app', 'Print templates'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("percentuali.php"); ?>"><?php echo Yii::t('app', 'Management statistics'); ?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("listini_nuovo.php"); ?>"><?php echo Yii::t('app', 'New prices list'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->oldUrl("listini_posti_barca.php"); ?>"><?php echo Yii::t('app', 'Resources price list'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/productGroup/admin'); ?>"><?php echo Yii::t('app', 'Products and services groups'); ?></a></li>
                    <li><a href="<?php echo Yii::app()->bridge->menuUrl('/admin/product/admin'); ?>"><?php echo Yii::t('app', 'Products and services'); ?></a></li>
                </ul>
            </li>    

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
            <a href="<?php echo Yii::app()->bridge->oldUrl("preferenze.php"); ?>" class="visible-xs" title="<?php echo Yii::t('app', 'Settings'); ?>">
                <i class="fa fa-wrench"></i> <?php echo Yii::t('app', "Settings"); ?></a>
            <a href="<?php echo Yii::app()->bridge->oldUrl("preferenze.php"); ?>" class="visible-sm visible-md visible-lg" rel="tooltip" data-toggle="tooltip" title="<?php echo Yii::t('app', 'Settings'); ?>" data-placement="bottom">
                <i class="fa fa-wrench"></i></a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->bridge->menuUrl('/site/logout'); ?>" class="visible-xs" title="<?php echo Yii::t('app', 'Sign out'); ?>">
                <i class="fa fa-sign-out"></i> <?php echo Yii::t('app', "Sign out"); ?></a>
            <a href="<?php echo Yii::app()->bridge->menuUrl('/site/logout'); ?>" class="visible-sm visible-md visible-lg" rel="tooltip" data-toggle="tooltip" title="<?php echo Yii::t('app', 'Sign out'); ?>" data-placement="bottom">
                <i class="fa fa-sign-out"></i></a>
            </li>
        </ul>
        <form class="hidden-xs hidden-sm navbar-form navbar-right" role="search" action="<?php echo Yii::app()->bridge->oldUrl("cerca.php"); ?>" method="post" id="formMainSearch">
            <div class="form-group">
                <input name="operatore" type="hidden" value="contiene" />
                <input type="text" class="form-control" placeholder="Cerca" style="width: 80px" name="ricerca" id="topNavbarMainSearch">
                <input type="text" class="form-control" placeholder="P.B." style="width: 50px" name="vai_al_pb" id="vai_al_pb">
            </div>
            <button type="submit" class="btn btn-default"><?php echo Yii::t('app', 'Go'); ?></button>
        </form>
    </div><!-- /.navbar-collapse -->
</nav>
<?php endif; ?>