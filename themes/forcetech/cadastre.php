<div class="container">
    <div class="content">
        <div class="row checkout-row">
            <div class="column column-12">
                <form class="form" method="post" id="cadastroCliente">
                    <div class="form_title">
                        <h3><strong>1</strong>Detalhes Importantes</h3>
                        <p>Alguns dados básicos</p>
                    </div>

                    <div class="step">                        
                        <div class="row">
                            <div class="column column-12">
                                <div class="form-field">
                                    <label>Nome Completo:</label>
                                    <input type="text" id="nome_completo" name="txtNome" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>E-mail</label>
                                    <input type="text" id="email" name="txtEmail" class="form-control">
                                </div>
                            </div>
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>CPF</label>
                                    <input type="text" id="name_card_cpf" name="txtCpf" maxlength="14"  class="form-control">
                                </div>
                            </div>
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>Data de Nasc.:</label>
                                    <input type="text" id="data_nasc" name="data_nasc" maxlength="10" placeholder="00/00/0000" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Senha</label>
                                    <input type="password" id="senha" name="txtSenha" class="form-control">
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Confirmar Senha</label>
                                    <input type="password" id="senha2" name="txtSenha2" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Telefone</label>
                                    <input type="text" id="telephone_booking" name="telephone_booking" maxlength="14" class="form-control">
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="form-field">
                                    <label>Celular</label>
                                    <input type="text" id="telephone_booking2" name="telephone_booking2" maxlength="15"  class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form_title">
                        <h3><strong>2</strong>Informações pessoais</h3>
                        <p>Precisamos de mais alguns dados de preenchimento, é bem rápido</</p>
                    </div>

                    <div class="step">                        
                        <div class="row">
                            <div class="column column-3">
                                <div class="form-field">
                                    <label>CEP</label>
                                    <input type="text" id="endereco_cep" name="endereco_cep" maxlength="8" class="form-control" placeholder="Sem traços" value="">
                                </div>
                            </div>
                            <div class="column column-9">
                                <div class="form-field">
                                    <label>Endereço</label>
                                    <input type="text" id="endereco_endereco" name="endereco_endereco"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>Nº</label>
                                    <input type="text" id="endereco_n" name="endereco_n" maxlength="15" class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-4">
                                <div class="form-field">
                                    <label>Bairro</label>
                                    <input type="text" id="endereco_bairro" name="endereco_bairro" class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-4">
                                <div class="form-field">
                                    <label>Cidade</label>
                                    <input type="text" id="endereco_cidade" name="endereco_cidade"  class="form-control" value="">
                                </div>
                            </div>
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>UF</label>
                                    <input type="text" id="endereco_uf" name="endereco_uf"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column column-12">
                                <div class="form-field">
                                    <label>Complemento</label>
                                    <input type="text" id="endereco_complemento" name="endereco_complemento"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-blue j_button" id="cadastroUsuario" name="btnUsuario" style="margin-right: 12px; text-align: center; padding: 11px;">
                            CADASTRE-SE
                        </button>                       
                        
                        <div class="row">
                            <div class="column column-12">
                                
                                <div class="resultado">
                                    <div class="msg"></div>
                                </div>                 
                            </div>                        
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= HOME;?>/_cdn/jquery-3.2.1.min.js"></script> 
<script src="<?= HOME;?>/_cdn/checkCadastre.js"></script>
