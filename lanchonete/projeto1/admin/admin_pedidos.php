<?php
    require_once "config.inc.php";

    $action = $_GET['action'] ?? '';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $message = '';

    if($action === 'deliver' && $id){
        $sql = "UPDATE pedidos SET status='Entregue', entregue_em=NOW() WHERE id = {$id}";
        if(mysqli_query($conexao, $sql)){
            $message = 'Pedido marcado como entregue.';
        } else {
            $message = 'Erro ao atualizar pedido: ' . mysqli_error($conexao);
        }
    }

    if($action === 'delete' && $id){
        $sql = "DELETE FROM pedidos WHERE id = {$id}";
        if(mysqli_query($conexao, $sql)){
            $message = 'Pedido excluído com sucesso.';
        } else {
            $message = 'Erro ao excluir pedido: ' . mysqli_error($conexao);
        }
    }

    // garantir que as tabelas de pedidos existem (cria se necessário)
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
    mysqli_query($conexao, $sql_pedidos_create);

    $sql_itens_create = "CREATE TABLE IF NOT EXISTS pedido_itens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pedido_id INT NOT NULL,
        comida_id INT NULL,
        nome VARCHAR(150) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        quantidade INT NOT NULL,
        FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
    )";
    // tentar criar tabela de itens (pode falhar em algumas configurações se FK não for suportada)
    @mysqli_query($conexao, $sql_itens_create);

    // detalhes
    $details = 0;
    if(isset($_GET['details']) && intval($_GET['details'])){
        $details = intval($_GET['details']);
    }

    // buscar pedidos
    $res = mysqli_query($conexao, "SELECT * FROM pedidos ORDER BY criado_em DESC");

    include_once 'menu_admin.php';
?>

<div class="container mt-3">
    <div class="admin-header d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="text-white mb-0">Pedidos</h2>
            <p class="text-muted small">Lista de pedidos recebidos — gerencie status e visualize detalhes.</p>
        </div>
        <div class="d-flex gap-2">
            <input id="searchCliente" type="search" class="form-control form-control-sm" placeholder="Pesquisar por cliente...">
            <select id="filterStatus" class="form-select form-select-sm">
                <option value="">Todos</option>
                <option value="Pendente">Pendente</option>
                <option value="Entregue">Entregue</option>
            </select>
        </div>
    </div>
    <style>
        .admin-header h2 { color: #fff; }
        .card-admin { background: rgba(255,255,255,0.06); padding: 18px; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.25); }
        .badge-pendente { background: #ffc107; color: #222; }
        .badge-entregue { background: #28a745; color: #fff; }
        .table-admin th { background: rgba(255,255,255,0.03); color:#fff; }
        .table-admin td { color: #f4f6f8; }
    </style>

    <div class="card-admin">
    <?php if($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if($details):
        $r = mysqli_query($conexao, "SELECT * FROM pedidos WHERE id = {$details}");
        $pedido = mysqli_fetch_assoc($r);
        if($pedido):
    ?>
        <h4>Detalhes do Pedido #<?= $pedido['id'] ?></h4>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente_nome']) ?></p>
        <?php if(!empty($pedido['telefone'])): ?>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($pedido['telefone']) ?></p>
        <?php endif; ?>
        <?php if(!empty($pedido['endereco'])): ?>
            <p><strong>Endereço:</strong> <?= nl2br(htmlspecialchars($pedido['endereco'])) ?></p>
        <?php endif; ?>
        <?php if(!empty($pedido['observacoes'])): ?>
            <p><strong>Observações:</strong> <?= nl2br(htmlspecialchars($pedido['observacoes'])) ?></p>
        <?php endif; ?>
        <p><strong>Criado em:</strong> <?= $pedido['criado_em'] ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($pedido['status']) ?> <?php if($pedido['entregue_em']) echo ' - Entregue em: '.$pedido['entregue_em']; ?></p>
        <h5>Itens</h5>
        <ul>
            <?php
                $it = mysqli_query($conexao, "SELECT * FROM pedido_itens WHERE pedido_id = {$details}");
                while($row = mysqli_fetch_assoc($it)){
                    echo '<li>'.htmlspecialchars($row['nome']).' x'.intval($row['quantidade']).' - R$ '.number_format($row['preco'],2,',','.').'</li>';
                }
            ?>
        </ul>
        <a href="index.php?pg=admin_pedidos" class="btn btn-secondary">Voltar</a>
    <?php else: ?>
        <div class="alert alert-warning">Pedido não encontrado.</div>
        <a href="index.php?pg=admin_pedidos" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>

    <?php else: ?>
        <div class="table-responsive">
        <table class="table table-striped table-admin align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Criado em</th>
                    <th>Status</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($pedido = mysqli_fetch_assoc($res)): ?>
                <tr data-cliente="<?= htmlspecialchars($pedido['cliente_nome']) ?>" data-status="<?= htmlspecialchars($pedido['status']) ?>">
                    <td class="align-middle"><strong>#<?= $pedido['id'] ?></strong></td>
                    <td class="align-middle"><?= htmlspecialchars($pedido['cliente_nome']) ?>
                        <?php if(!empty($pedido['endereco'])): ?><div class="small text-muted"><?= htmlspecialchars(substr($pedido['endereco'],0,60)) ?><?php if(strlen($pedido['endereco'])>60) echo '...'; ?></div><?php endif; ?>
                    </td>
                    <td class="align-middle"><?= htmlspecialchars($pedido['telefone']) ?></td>
                    <td class="align-middle"><?= $pedido['criado_em'] ?></td>
                    <td class="align-middle">
                        <?php if($pedido['status'] === 'Entregue'): ?>
                            <span class="badge badge-entregue">Entregue</span>
                        <?php else: ?>
                            <span class="badge badge-pendente">Pendente</span>
                        <?php endif; ?>
                        <?php if($pedido['entregue_em']): ?>
                            <div class="small text-muted">Entregue em: <?= $pedido['entregue_em'] ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="text-end align-middle">
                        <div class="btn-group" role="group">
                            <?php if($pedido['status'] !== 'Entregue'): ?>
                                <a href="index.php?pg=admin_pedidos&action=deliver&id=<?= $pedido['id'] ?>" class="btn btn-success btn-sm" title="Marcar como entregue">✓</a>
                            <?php endif; ?>
                            <a href="index.php?pg=admin_pedidos&details=<?= $pedido['id'] ?>" class="btn btn-primary btn-sm" title="Ver detalhes">i</a>
                            <a href="index.php?pg=admin_pedidos&action=delete&id=<?= $pedido['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este pedido?')" title="Deletar">✕</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
    </div>
    <script>
        
        const searchInput = document.getElementById('searchCliente');
        const filterSelect = document.getElementById('filterStatus');
        searchInput && searchInput.addEventListener('input', applyFilters);
        filterSelect && filterSelect.addEventListener('change', applyFilters);
        function applyFilters(){
            const q = searchInput.value.toLowerCase();
            const st = filterSelect.value;
            document.querySelectorAll('table.table-admin tbody tr').forEach(tr=>{
                const cliente = (tr.dataset.cliente||'').toLowerCase();
                const status = tr.dataset.status||'';
                const show = (cliente.indexOf(q) !== -1) && (st === '' || st === status);
                tr.style.display = show? '':'none';
            });
        }
    </script>
</div>
