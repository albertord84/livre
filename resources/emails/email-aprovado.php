<table width="650" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center" style="@import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900');font-family: 'Roboto', sans-serif;font-size:13px;color:#3e3e3e;">
    <tbody>
        <tr>
            <td colspan="3" height="180" bgcolor="#00ff66" align="center">
                <h1 style="font-weight: 600;font-size: 30px;line-height: 30px">Empréstimo aprovado!</h1>
            </td>
        </tr>
        <tr>
            <td width="105"></td>
            <td width="440" valign="top" align="center" height="40">
                <br><br>
                <img src="../../assets/img/icones/11 - dinheiro na conta2.png" alt="">   
                <br><br>
                <div style="text-align: left;">
                    <h2 style="color: #20a7d3;">Oi <?php echo urldecode($_GET["name"]);?>, pode comemorar!</h2>
                    <p>
                        O valor solicitado acaba de ser aprovado, está sendo processado e será transferido para sua conta.    <br>                        
                    <br><h3>Prazo para depósito: 1 dia útil.</h3>
                    </p> 					
                    Dados bancários:<br>
                    <?php echo urldecode($_GET["bank_name"]);?><br>
                    Conta <?php echo urldecode($_GET["account"]);?><br>
                    Agência <?php echo urldecode($_GET["agency"]);?><br>
                    <?php echo urldecode($_GET["full_name"]);?><br>                    
                </div> 
                <div>
                    <p>Ficamos felizes por poder ajudar você e agradecemos por usar a Livre.Digital. Se você gostou divulgue para seus amigos sua experiência!</p>
                </div>
                <div>
                    <br><br>
                    <h2 style="color: #20a7d3;">Está com dúvidas?</h2>
                    <p>
                        Fale com a gente pelo e-mail: <br><b>seja@livre.digital</b>
                    </p> 
                </div>      
            </td>
            <td width="105"></td>
        </tr>
        <tr>
            <td colspan="3" width="650" valign="middle" align="center" height="120">
                <img src="../../assets/img/icones/logo-mkt.png">
            </td>
        </tr>
    </tbody>
</table>