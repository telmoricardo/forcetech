<?php

class CalcularFrete {

    public function Frete($cepOrigem, $cepDestino, $tipoFrete, $peso) {
        //PAC:41106
        //SEDEX:40010
                
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
        $url .= 'nCdEmpresa=0&';
        $url .= 'sDsSenha=0&';
        $url .= 'nCdServico='.$tipoFrete.'&';
        $url .= 'sCepOrigem=' . $cepOrigem . '&';
        $url .= 'sCepDestino=' . $cepDestino . '&';
        $url .= 'nVlPeso='.$peso.'&';
        $url .= 'nCdFormato=1&';
        $url .= 'nVlComprimento=16&';
        $url .= 'nVlAltura=16&';
        $url .= 'nVlLargura=21&';
        $url .= 'nVlDiametro=11&';
        $url .= 'sCdMaoPropria=S&';
        $url .= 'nVlValorDeclarado=0&';
        $url .= 'sCdAvisoRecebimento=N&';
        $url .= 'StrRetorno=xml&';
        $url .= 'nIndicaCalculo=3';
        $xml = simplexml_load_file($url);
        
        return $xml->cServico;
//        $valor = $frete->Valor;
//        $prazo = $frete->PrazoEntrega;
    }

}
