<!-- cardapio.php (para a página pública, NÃO admin) -->
<?php
    require_once "admin/config.inc.php";
    $sql = "SELECT * FROM comidas ORDER BY categoria";
    $resultado = mysqli_query($conexao, $sql);
    // helper: gerar slug a partir do nome (usado na busca de imagens)
    if (!function_exists('_slugify')) {
        function _slugify($t){
            $t = mb_strtolower($t, 'UTF-8');
            $t = preg_replace('/[áàãâä]/u', 'a', $t);
            $t = preg_replace('/[éèêë]/u', 'e', $t);
            $t = preg_replace('/[íìîï]/u', 'i', $t);
            $t = preg_replace('/[óòõôö]/u', 'o', $t);
            $t = preg_replace('/[úùûü]/u', 'u', $t);
            $t = preg_replace('/[^a-z0-9]+/', '-', $t);
            $t = trim($t, '-');
            return $t;
        }
    }
?>

<div class="container my-5">
    <style>
        .cardapio-heading {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .categoria-title {
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            font-size: 1.35rem;
            border-left: 4px solid #ff8c42;
            padding-left: 0.75rem;
        }
        .price-badge {
            font-weight: 700;
            font-size: 0.95rem;
        }
        .cardapio-card .card-body {
            padding-bottom: 0.5rem;
        }
    </style>

    <h2 class="cardapio-heading">🍔 Cardápio da Lanchonete</h2>

    <?php
        $categoria_atual = '';
        $first = true;
        while($comida = mysqli_fetch_array($resultado)){
            if($categoria_atual != $comida['categoria']){
                if(!$first) echo "</div>"; 
                $first = false;
                $categoria_atual = htmlspecialchars($comida['categoria']);
                echo "<h3 class='categoria-title'>" . $categoria_atual . "</h3>";
                echo "<div class='row g-3 itens-categoria'>";
            }
            // use raw name for slug generation, but escape for display
            $rawNome = $comida['nome'];
            $nome = htmlspecialchars($rawNome);
            $descricao = htmlspecialchars($comida['descricao']);
            $preco = number_format($comida['preco'], 2, ',', '.');
    ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card cardapio-card h-100">
                <?php
                    // procura por imagem usando slug (nome do item) -> aceita png/jpg/jpeg/webp
                    // NOTE: _slugify() é definida no topo do arquivo para evitar redeclaração
                    $baseDir = __DIR__ . '/Imagens/comidas/';
                    $extensions = ['png','jpg','jpeg','webp'];
                    $imgPath = '';
                    // gerar slug a partir do valor bruto (sem entidades HTML)
                    $slug = _slugify($rawNome);
                    foreach($extensions as $ext){
                        if(file_exists($baseDir . $slug . '.' . $ext)){
                            $imgPath = 'Imagens/comidas/' . $slug . '.' . $ext;
                            break;
                        }
                    }
                    if(!$imgPath){
                        // tenta nome limpo (com espaços convertidos)
                        $clean = preg_replace('/[^A-Za-z0-9\-_.]+/','',str_replace(' ','-',$nome));
                        foreach($extensions as $ext){
                            if(file_exists($baseDir . $clean . '.' . $ext)){
                                $imgPath = 'Imagens/comidas/' . $clean . '.' . $ext;
                                break;
                            }
                        }
                    }
                    // NÃO usar fallback por ID — somente busca por nomes/slug/clean
                    // placeholder SVG embutido (usado quando não houver imagem por nome)
                    $placeholder = 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22360%22 height=%22140%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23888%22 font-size=%2214%22 font-family=%22Arial,Helvetica,sans-serif%22%3ESem+imagem%3C/text%3E%3C/svg%3E';
                    $src = $imgPath ? $imgPath : $placeholder;
                ?>
                <img src="<?= $src ?>" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22360%22 height=%22140%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23888%22 font-size=%2214%22 font-family=%22Arial,Helvetica,sans-serif%22%3ESem+imagem%3C/text%3E%3C/svg%3E';" class="card-img-top" alt="<?= $nome ?>" style="height:140px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2"><?= $nome ?></h5>
                    <?php if(!empty($descricao)) { ?>
                        <p class="card-text text-muted small mb-3"><?= $descricao ?></p>
                    <?php } else { ?>
                        <p class="card-text text-muted small mb-3">&nbsp;</p>
                    <?php } ?>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="price-badge badge bg-warning text-dark">R$ <?= $preco ?></span>
                        <a href="carrinho.php?action=add&id=<?= $comida['id'] ?>&nome=<?= urlencode($comida['nome']) ?>&preco=<?= $comida['preco'] ?>" class="btn btn-sm btn-primary">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    </div> 
