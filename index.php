<!DOCTYPE html>
<html lang="pt">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Suporte</title>
</head>
<body>

<form method="post" name="dados" action="crud.php?acao=inserir" onSubmit="return enviardados();">
  <fieldset>
    <legend>Suporte!</legend>
    <!--<p>-->
    <!--<label for="size_1">Id:</label>  -->
    <!--<input type="text" name="dados_id" id="dados_id" value="" />-->
    <!--</p>-->
    <p>
    <label for="size_1">Nome Completo:</label>  
    <input type="text" name="nome" id="nome" value="" />
    </p>
    <p>
    <label for="size_1">E-mail:</label>  
    <input type="text" name="email" id="email" value="" />
    </p>
    <tr><td>
    <label for="size_1">Data:</label>  
     <font size="2">
     <input name="data" type="date" id="data" class="formbutton">
     </font>
    </td></tr>
    <p>
    <label for="size_1">Qual sua dúvida?</label><br>  
    <textarea name="duvida" cols="50" rows="8" class="formbutton" id="duvida" input></textarea>
    </p>
    <tr>
            <td height="22"></td>
            <td>
               <input name="Submit" type="submit" class="formobjects" value="Cadastrar">
               <input name="Reset" type="reset" class="formobjects" value="Limpar campos">
               <input name="Ler" type="submit" formaction="crud.php?acao=selecionar" value="Ler"> 
            </td>
         </tr>
  </fieldset>
</form>

</body>
</html>