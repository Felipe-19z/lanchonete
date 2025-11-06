<?php
session_start();

// Inicializa o carrinho
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

// Função para normalizar entrada
function floatval_pt($v){
    return floatval(str_replace(',', '.', $v));
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Processar ações: add, increase, decrease, remove, finalize, clear
if($action === 'add'){
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $nome = isset($_GET['nome']) ? urldecode($_GET['nome']) : '';
    $preco = isset($_GET['preco']) ? floatval($_GET['preco']) : 0;
    if($id){
        if(!isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] = ['id'=>$id,'nome'=>$nome,'preco'=>$preco,'qtd'=>1];
        } else {
            $_SESSION['cart'][$id]['qtd'] += 1;
        }
    }
}

if($action === 'increase'){
    $id = $_GET['id'] ?? '';
    if($id && isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['qtd'] += 1;
    }
    header('Location: carrinho.php'); exit;
}

if($action === 'decrease'){
    $id = $_GET['id'] ?? '';
    if($id && isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['qtd'] -= 1;
        if($_SESSION['cart'][$id]['qtd'] <= 0) unset($_SESSION['cart'][$id]);
    }
    header('Location: carrinho.php'); exit;
}

if($action === 'remove'){
    $id = $_GET['id'] ?? '';
    if($id && isset($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
    }
    header('Location: carrinho.php'); exit;
}

$message = '';
if($action === 'finalize'){
    // Finalizar pedido: recebe nome do cliente via POST e salva no banco
    $cliente = isset($_POST['cliente_nome']) ? trim($_POST['cliente_nome']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : '';
    $observacoes = isset($_POST['observacoes']) ? trim($_POST['observacoes']) : '';
    if(empty($cliente) || empty($_SESSION['cart'])){
        $message = 'Informe seu nome e tenha pelo menos um item no carrinho.';
    } else {
        // inserir pedido no banco
        require_once __DIR__ . '/admin/config.inc.php';

        // Garantir que as tabelas de pedidos existam (evita fatal error se setup não foi executado)
        $sql_pedidos_create = "CREATE TABLE IF NOT EXISTS pedidos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cliente_nome VARCHAR(150) NOT NULL,
            status VARCHAR(50) NOT NULL DEFAULT 'Pendente',
            criado_em DATETIME NOT NULL,
            entregue_em DATETIME NULL,
            telefone VARCHAR(50) DEFAULT NULL,
            endereco TEXT DEFAULT NULL,
            observacoes TEXT DEFAULT NULL
        )";
        @mysqli_query($conexao, $sql_pedidos_create);

        $sql_itens_create = "CREATE TABLE IF NOT EXISTS pedido_itens (
            id INT AUTO_INCREMENT PRIMARY KEY,
            pedido_id INT NOT NULL,
            comida_id INT NULL,
            nome VARCHAR(150) NOT NULL,
            preco DECIMAL(10,2) NOT NULL,
            quantidade INT NOT NULL,
            FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
        )";
        @mysqli_query($conexao, $sql_itens_create);

        $cliente_esc = mysqli_real_escape_string($conexao, $cliente);
        $telefone_esc = mysqli_real_escape_string($conexao, $telefone);
        $endereco_esc = mysqli_real_escape_string($conexao, $endereco);
        $observacoes_esc = mysqli_real_escape_string($conexao, $observacoes);
        $agora = date('Y-m-d H:i:s');
        $sql = "INSERT INTO pedidos (cliente_nome, status, criado_em, telefone, endereco, observacoes) VALUES ('{$cliente_esc}', 'Pendente', '{$agora}', '{$telefone_esc}', '{$endereco_esc}', '{$observacoes_esc}')";
        if(mysqli_query($conexao, $sql)){
            $pedido_id = mysqli_insert_id($conexao);
            // inserir itens
            foreach($_SESSION['cart'] as $it){
                $id_item = intval($it['id']);
                $nome_item = mysqli_real_escape_string($conexao, $it['nome']);
                $preco_item = floatval($it['preco']);
                $qtd = intval($it['qtd']);
                $sql2 = "INSERT INTO pedido_itens (pedido_id, comida_id, nome, preco, quantidade) VALUES ({$pedido_id}, ".($id_item? $id_item: 'NULL').", '{$nome_item}', {$preco_item}, {$qtd})";
                mysqli_query($conexao, $sql2);
            }
            // limpar carrinho e mensagem de sucesso
            $_SESSION['cart'] = array();
            $message = 'Seu pedido foi realizado, Aguarde pois chegará em breve.';
        } else {
            $message = 'Erro ao registrar pedido. Tente novamente.';
        }
    }
}

include_once 'topo.php';
include_once 'menu.php';
?>

<div class="container my-4">
    <h2>Carrinho</h2>

    <?php if($message): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
        <?php // redirecionar para index.php após 3 segundos ?>
        <meta http-equiv="refresh" content="3;url=index.php">
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <?php if(empty($_SESSION['cart'])): ?>
                <p>Seu carrinho está vazio. Volte ao <a href="index.php">início</a> para adicionar itens.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-end">Preço uni.</th>
                            <th class="text-end">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; foreach($_SESSION['cart'] as $item):
                            $subtotal = $item['preco'] * $item['qtd'];
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nome']) ?></td>
                            <td class="text-center">
                                <?= $item['qtd'] ?> x
                                <div class="btn-group ms-2" role="group">
                                    <a class="btn btn-sm btn-outline-secondary" href="carrinho.php?action=decrease&id=<?= $item['id'] ?>">-</a>
                                    <a class="btn btn-sm btn-outline-secondary" href="carrinho.php?action=increase&id=<?= $item['id'] ?>">+</a>
                                </div>
                            </td>
                            <td class="text-end">R$ <?= number_format($item['preco'],2,',','.') ?></td>
                            <td class="text-end">R$ <?= number_format($subtotal,2,',','.') ?></td>
                            <td class="text-end"><a href="carrinho.php?action=remove&id=<?= $item['id'] ?>" class="btn btn-sm btn-danger">Remover</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td class="text-end"><strong>R$ <?= number_format($total,2,',','.') ?></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="row">
                    <div class="col-md-6">
                        <a href="index.php" class="btn btn-secondary">Continuar comprando</a>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="carrinho.php?action=finalize" class="row g-2">
                            <div class="col-12 col-md-4">
                                <input type="text" id="cliente_nome" name="cliente_nome" class="form-control form-control-sm" placeholder="Seu nome" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <input type="text" id="telefone" name="telefone" class="form-control form-control-sm" placeholder="Telefone (opcional)">
                            </div>
                            <div class="col-12 col-md-5">
                                <input type="text" id="endereco" name="endereco" class="form-control form-control-sm" placeholder="Endereço (opcional)">
                            </div>
                            <div class="col-12">
                                <textarea id="observacoes" name="observacoes" class="form-control form-control-sm" placeholder="Observações (opcional)"></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success">Finalizar Pedido</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once 'rodape.php'; ?>
