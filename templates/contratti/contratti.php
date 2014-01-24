{include file="header.tpl"}

<h1><i class="fa fa-file-text"></i> Contratti</h1>

<div class="row">

<p>
<strong>Tipo di Contratto: </strong>
<a href="contratti.php?tipo=1">{if $contratto_tipo == 1}<strong>Affitto</strong>{else}Affitto{/if}</a> 
<a href="contratti.php?tipo=2">{if $contratto_tipo == 2}<strong>Vendita</strong>{else}Vendita{/if}</a> 
<a href="contratti.php?tipo=13">{if $contratto_tipo == 13}<strong>Opzione</strong>{else}Opzione{/if}</a> 
<a href="contratti.php?tipo=3">{if $contratto_tipo == 3}<strong>Gestione</strong>{else}Gestione{/if}</a> 
<a href="contratti.php?tipo=4">{if $contratto_tipo == 4}<strong>Prenotazione</strong>{else}Prenotazione{/if}</a> 
<a href="contratti.php?tipo=11">{if $contratto_tipo == 11}<strong>Transito</strong>{else}Transito{/if}</a>
</td>
</p>
<p><strong>Anno: </strong>{$anni}</p>
<p><strong>Mese: </strong>{$mesi}</p>
<p>{$paginazione}</p>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <thead>
        <td>P.B.</td>
        <td>Barca</td>
        <td>Cliente</td>
        <td>Durata</td>
        <td>Totale</td>
        <td>Fatturato</td>        
        <td>&nbsp;</td>
    </thead>
    <tbody>

        {while $row_contratti = mysql_fetch_array($result_contratti)}
        <tr>
            <td>{$row_contratti["pontile_codice"]} {$row_contratti["posto_barca_numero"]}</td>
            <td><a href="barca_visualizza.php?id={$row_contratti['contratto_barca']}">{$elenco_barche[$row_contratti["contratto_barca"]]}</a></td>
            <td>
                {if $contratto_tipo == 3}
                    <a href="cliente_visualizza.php?id={$row_contratti['contratto_anagrafica1']}">
                    {$elenco_clienti[$row_contratti['contratto_anagrafica1']]}</a>
                {else} 
                    <a href="cliente_visualizza.php?id={$row_contratti['contratto_anagrafica2']}">
                    {$elenco_clienti[$row_contratti['contratto_anagrafica2']]}</a>
                {/if}
            </td>
            <td>
            {php}
            {}
            </td>
            <td>{$row_contratti["pontile_codice"]} {$row_contratti["posto_barca_numero"]}</td>
            <td>{$row_contratti["pontile_codice"]} {$row_contratti["posto_barca_numero"]}</td>
            <td>{$row_contratti["pontile_codice"]} {$row_contratti["posto_barca_numero"]}</td>
        </tr>
        {/while}
        
    </tbody>
</table>
</div>
    <?php
    while ($row_contratti=mysql_fetch_array($result_contratti))
    {
        $pontile_codice=$row_contratti['pontile_codice'];
        $posto_barca_numero=$row_contratti['posto_barca_numero'];
    ?>
    <tr>
        <td class="tdContenutoVisualizzazione">
        <?php
        $data=$sql->data_ita($row_contratti['contratto_data']);
        $inizio=$sql->data_ita($row_contratti['contratto_inizio']);
        $fine=$sql->data_ita($row_contratti['contratto_fine']);     
        if ($inizio[0]!="00-00-0000" and $fine[0]!="00-00-0000")
        {
        ?>          <?php echo $inizio[0]; ?> <?php echo $fine[0]; ?>
        <?php
        }
        else
        {
        ?>
            Data del contratto: <?php echo $data[0]; ?>
        <?php
        }
        ?>
        </td>
        <td class="tdContenutoVisualizzazione">
        <?php $totale=$sql->decimale_ita($row_contratti['contratto_totale']); echo $totale; ?>
        <?php
        if ($row_contratti['contratto_sconto']>0)
        {
            echo " (".number_format(($row_contratti['contratto_totale']-($row_contratti['contratto_totale']/100*$row_contratti['contratto_sconto'])),2,",","").")";
        }
        ?>
        </td>
        <td class="tdContenutoVisualizzazione"><?php $fatturato=$sql->decimale_ita($row_contratti['contratto_fatturato']); echo $fatturato; ?></td>
        <td class="tdContenutoVisualizzazione">
        <a href="riepilogo.php?id=<?php echo $row_contratti['contratto_id']; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('contratto_id','','icone/btn_visualizza_hover.gif',1)"><img src="icone/btn_visualizza.gif" name="Contratto<?php echo $row_contratti['contratto_id']; ?>" width="21" height="23" border="0" id="Contratto<?php echo $row_contratti['contratto_id']; ?>" /></a>
        <a href="contratto_elimina.php?id=<?php echo $row_contratti['contratto_id']; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('contratto_id','','icone/btn_elimina_hover.gif',1)"><img src="icone/btn_elimina.gif" name="Elimina<?php echo $row_contratti['contratto_id']; ?>" width="23" height="21" border="0" id="Elimina<?php echo $row_contratti['contratto_id']; ?>" /></a>
        <a href="contratto_modifica.php?id=<?php echo $row_contratti['contratto_id']; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('contratto_id','','icone/btn_modifica_hover.gif',1)"><img src="icone/btn_modifica.gif" name="Modifica<?php echo $row_contratti['contratto_id']; ?>" width="27" height="23" border="0" id="Modifica<?php echo $row_contratti['contratto_id']; ?>" /></a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

</div>
{include file="footer.tpl"}