<?php

include "Conn.php";

class Usuario extends Conn
{
    public function getAll($limit, $offset, $pesquisa = '')
    {
        $sql = "SELECT * FROM usuario WHERE id >= ? AND nome LIKE ? LIMIT ? OFFSET ?";

        $true = 1;
        $pesquisa = "%" . $pesquisa . "%";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param("isii", $true, $pesquisa, $limit, $offset);

        $stmt->execute();
        $result = $stmt->get_result();
        $retultado = $result->fetch_all(MYSQLI_ASSOC);

        return $retultado;
       
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $retultado = $result->fetch_assoc();

        return $retultado;
       
    }

    public function getOneByCpf($cpf)
    {
        $sql = "SELECT * FROM usuario WHERE cpf = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $cpf);

        $stmt->execute();
        $result = $stmt->get_result();
        $retultado = $result->fetch_assoc();

        return $retultado;
       
    }

    public function existeCpf($cpf)
    {
        $sql = "SELECT * FROM usuario WHERE cpf = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $cpf);

        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0;
    }

    public function insert($dados)
    {
        $sql = "INSERT INTO `usuario` (
            `uuid`,
            `nome`,
            `cpf`,
            `email`,
            `senha`,
            `permissao`,
            `data_criacao`,
            `data_atualizacao`,
            `status`
        ) VALUES (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        );";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssi", 
            $dados['uuid'],
            $dados['nome'],
            $dados['cpf'],
            $dados['email'],
            $dados['senha'],
            $dados['permissao'],
            $dados['data_criacao'],
            $dados['data_atualizacao'],
            $dados['status']
        );
        
        $stmt->execute();

        $this->conn->close();
    }

    public function update($id, $dados)
    {
        $id = (int) $id;
        $sql = "UPDATE `usuario` SET 
            `nome` = ?,
            `cpf` = ?,
            `email` = ?,
            `permissao` = ?,
            `data_atualizacao` = ?,
            `status` = ?
            WHERE `usuario`.`id` = ?;";

        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssii", 
            $dados['nome'],
            $dados['cpf'],
            $dados['email'],
            $dados['permissao'],
            $dados['data_atualizacao'],
            $dados['status'],
            $id
        );
        
        $stmt->execute();

        // $this->conn->close();
    }
}
