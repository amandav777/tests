<?php
require "src/GerenciadorDeTarefas.php";
use PHPUnit\Framework\TestCase;

class GerenciadorDeTarefasTest extends TestCase
{
    protected $gerenciador;

    protected function setUp(): void
    {
        $this->gerenciador = new GerenciadorDeTarefas();
    }

    public function testCriarTarefaValida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 1', 'Descrição da tarefa', '2024-12-31');
        $tarefas = $this->gerenciador->listarTarefas();
        $this->assertArrayHasKey($id, $tarefas);
        $this->assertEquals('Tarefa 1', $tarefas[$id]['titulo']);
    }

    public function testCriarTarefaSemTitulo()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->criarTarefa('', 'Descrição', '2024-12-31');
    }

    public function testCriarTarefaSemPrazo()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->criarTarefa('Título', 'Descrição', '');
    }

    public function testConcluirTarefaValida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 2', 'Descrição', '2024-12-31');
        $this->gerenciador->concluirTarefa($id);
        $tarefas = $this->gerenciador->listarTarefas();
        $this->assertEquals('concluída', $tarefas[$id]['status']);
    }

    public function testConcluirTarefaInexistente()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->concluirTarefa('id_inexistente');
    }

    public function testConcluirTarefaJaConcluida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 3', 'Descrição', '2024-12-31');
        $this->gerenciador->concluirTarefa($id);
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->concluirTarefa($id); // Tarefa já concluída
    }

    public function testAtribuirTarefaValida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 4', 'Descrição', '2024-12-31');
        $this->gerenciador->atribuirTarefa($id, 'Usuário 1');
        $tarefas = $this->gerenciador->listarTarefas();
        $this->assertEquals('Usuário 1', $tarefas[$id]['usuario']);
    }

    public function testAtribuirTarefaInexistente()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->atribuirTarefa('id_inexistente', 'Usuário 1');
    }

    public function testListarTarefasPorStatus()
    {
        $id1 = $this->gerenciador->criarTarefa('Tarefa 5', 'Descrição', '2024-12-31');
        $id2 = $this->gerenciador->criarTarefa('Tarefa 6', 'Descrição', '2024-12-31');
        $this->gerenciador->concluirTarefa($id1);
        $tarefasConcluidas = $this->gerenciador->listarTarefas('concluída');
        $this->assertArrayHasKey($id1, $tarefasConcluidas);
        $this->assertArrayNotHasKey($id2, $tarefasConcluidas);
    }

    public function testExcluirTarefaValida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 7', 'Descrição', '2024-12-31');
        $this->gerenciador->excluirTarefa($id);
        $tarefas = $this->gerenciador->listarTarefas();
        $this->assertArrayNotHasKey($id, $tarefas);
    }

    public function testExcluirTarefaInexistente()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->excluirTarefa('id_inexistente');
    }

    public function testExcluirTarefaJaConcluida()
    {
        $id = $this->gerenciador->criarTarefa('Tarefa 8', 'Descrição', '2024-12-31');
        $this->gerenciador->concluirTarefa($id);
        $this->expectException(InvalidArgumentException::class);
        $this->gerenciador->excluirTarefa($id); 
    }
}