<?php

// Extend the TCPDF class to create custom Header and Footer
class MyPdf extends TCPDF 
{

    protected $htmlHeader;

    protected $htmlFooter;

    public function setHtmlHeader($htmlHeader) 
    {
        $this->htmlHeader = $htmlHeader;
    }

    public function setHtmlFooter($htmlFooter) 
    {
        $this->htmlFooter = $htmlFooter;
    }

    public function Header() 
    {
        $html = $this->htmlHeader;
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }

    // Page footer
    public function Footer() 
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $html = $this->htmlFooter;
        $html = str_replace(array('CURRENT_PAGE', 'TOTAL_PAGES'), array($this->getAliasNumPage(), $this->getAliasNbPages()), $html);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        
    }
}