<?php
include_once "conexao2.php";

$acao = $_GET['acao'];

if(isset($_GET['dados_id'])){

    $id = $_GET['dados_id'];
}


switch ($acao){
    case 'inserir':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $duvida = $_POST['duvida'];
        
        $sqlInsert = "INSERT INTO dados (nome, email, data, duvida) VALUES ('$nome', '$email', '$data', '$duvida')";

        if(!mysqli_query($conexao2,$sqlInsert))
        {
            die("Erro ao inserir informações" . mysqli_error($conexao2));
        }
        else
        {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
        break;

    case 'montar':
        $id = $_GET['id'];
        $sql = "SELECT * FROM dados WHERE dados_id = ". $id;
        $resultado = mysqli_query($conexao2,$sql) or die('Erro ao retornar dados');

        echo "<form method='post' name='dados' action='crud.php?acao=atualizar' onSubmit='return enviardados();'>";
        echo "<table width='588' border='0' align='center'>";
        while ($registro = mysqli_fetch_array($resultado)){
            echo "   <tr>";
            echo "    <td width='118'><font size ='1' face='Verdana,Arial,Helvetica,sans-serif'>Código:</font></td>";
            echo " <td width='460'>";
            echo "      <input name='id' type='text' class='formbutton' id='id' size='5' maxlength='10' value='" . $id ."' readonly>";
            echo "</td>";
            echo "     </tr>";

            echo " <tr>";
            echo " <td> <font face ='Verdana, Arial, Helvetica , sans-serif'><font size='1'> Nome <strong>:</strong></font></td>";
            echo " <td rowspan='2'> <font size='2'>";
            echo "<style> textarea{resize:none;}></style>";
            echo "<textarea name='nome' cols='50' rows='3' class='formbutton'>" .htmlspecialchars ($registro['nome']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";

            echo " <tr> ";
            echo " <tr> ";
            echo "<td> <font face ='Verdana,Arial,Helvetica , sans-serif'> <font size ='1'> Email <strong> : </strong></font></td>";
            echo " <td rowspan ='2' <font size='2'>";
            echo "<textarea name='email' cols='50' rows'8' class='formbutton'>"  . htmlspecialchars ($registro['email']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "</tr>";

            echo " <tr> ";
            echo "<tr>";
            echo "<td> <font face ='Verdana,Arial,Helvetica , sans-serif'> <font size ='1'> Data <strong> : </strong></font></td>";
            echo " <td rowspan ='2' <font size='2'>";
            echo "<textarea name='data' cols='50' rows'8' class='formbutton'>" . htmlspecialchars ($registro['data']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "</tr>";


            echo " <tr> ";
            echo " <tr> ";
            echo "<td> <font face ='Verdana,Arial,Helvetica , sans-serif'> <font size ='1'> Mensagem <strong> : </strong></font></td>";
            echo " <td rowspan ='4' <font size='2'>";
            echo "<textarea name='duvida' cols='50' rows'8' class='formbutton'>"  . htmlspecialchars ($registro['duvida']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "</tr>";
            
            echo"</table>";

        echo"<center>";
           echo " <tr>";
           echo " <td height='22'></td>";
           echo "  <td>";
           echo "  <input name='Submit' type='submit' class='formobjects' value='Atualizar'>";
           echo "   <input name='Reset' type='reset' class='formobjects' value='Limpar campos'>";
           echo "  <input name='Ler' type='submit' formaction='crud.php?acao=selecionar' value='Ler'> ";
           echo "  </td>";
           echo " </tr>";
           echo"</center>";
            echo"</form>";


        }
        mysqli_close($conexao2);
        break;

    case'atualizar':
        $codigo = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $duvida = $_POST['duvida'];

        $sql = "UPDATE dados SET nome ='$nome' , email = '$email ' , data ='$data ', duvida = '$duvida' WHERE dados_id = '$codigo' ";

        if (!mysqli_query($conexao2,$sql)){
            die('</br> Erro no comando SQL UPDATE: '. mysqli_error($conexao2));
            echo "<script language='javascript' type='text/javascript'>
            alert('ERRO!!')
            wind ow.location.href='crud.php?acao=selecionar'</script>";
        }else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados atualizados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
        break;

        case 'deletar':

            $id = $_GET['id'];
            $sql = "DELETE FROM dados WHERE dados_id = '".$id."'";
    
            if(!mysqli_query($conexao2,$sql))
        {
            die("erro ao inserir informações" . mysqli_error($conexao2));
        }
            else
        {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados Deletados!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
        mysqli_close($conexao2);
        header("Location:crud.php?acao=selecionar");
    
    
            break;

    case 'selecionar':
        date_default_timezone_set('America/Sao_Paulo');

        echo "<meta charset=utf-8>";
        echo "<center><table border=1>";
        echo "<tr>";
        echo "<th>CODIGO</th>";
        echo "<th>NOME</th>";
        echo "<th>EMAIL</th>";
        echo "<th>DATA</th>";
        echo "<th>DÚVIDA</th>";
        echo "<th>FUNÇÕES</th>";

        echo "</tr>";
        
        $sql = "SELECT * FROM dados";
        $resultado = mysqli_query($conexao2, $sql) or die("Erro ao retornar dados");


        echo "<CENTER>REGISTROS CADASTRADOS NA BASE DE DADOS!<br/></CENTER>";
        echo "<br>";

        while($registro = mysqli_fetch_array($resultado)){
            $id = $registro['dados_id'];
            $nome = $registro['nome'];
            $email = $registro['email'];
            $data = $registro['data'];
            $duvida = $registro['duvida'];
            
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $nome . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td>" . date("d/m/Y", strtotime($data)) . "</td>";
            echo "<td>" . $duvida . "</td>";
            echo "<td><a href='crud.php?acao=deletar&id=$id'><img src='delete.png' alt='Deletar' title='Deletar registro'></a>
            <a href='crud.php?acao=montar&id=$id'><img src='update.png' alt='Atualizar' title='Atualizar registros'>
            </a>
            <a href='index.php'><img src='insert.png' alt='Inserir' title='Inserir registro'></a></td>";
            echo "</tr>";

        }

        mysqli_close($conexao2);
        break;

    default:
        header("Location:crud.php?acao=selecionar");
        break;
}
?>