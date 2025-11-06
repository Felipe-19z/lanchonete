<!-- Carousel dos Hambúrgueres -->
<div class="container py-4"> <!-- Container com padding vertical -->
<style>
    #carouselHamburguer {
        max-width: 800px;
        height: 500px;
        margin: 20px auto; /* Centraliza o carousel e adiciona espaço vertical */
        border-radius: 15px; /* Cantos arredondados */
        overflow: hidden; /* Mantém as imagens dentro do border-radius */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    #carouselHamburguer img {
        width: 100%;
        height: 500px;
        object-fit: cover; /* Mantém a proporção da imagem */
    }
    /* Ajusta o tamanho em telas menores */
    @media (max-width: 850px) {
        #carouselHamburguer {
            max-width: 90%;
            height: 400px;
        }
        #carouselHamburguer img {
            height: 400px;
        }
    }
</style>
<div id="carouselHamburguer" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Hamburguer Tradicional"></button>
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="1" aria-label="Sertanejo"></button>
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="2" aria-label="X-Calabresa"></button>
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="3" aria-label="X-Frango"></button>
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="4" aria-label="X-Picanha"></button>
    <button type="button" data-bs-target="#carouselHamburguer" data-bs-slide-to="5" aria-label="X-Tudo"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Imagens/Hamburger-Tradicional.png" class="d-block w-100" alt="Hamburguer Tradicional">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>Hamburguer Tradicional</h4>
        <p>Pão Normal, Hamburguer, Alface, Queijo Muçarela, Tomate, Cebola</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Imagens/Sertanejo.png" class="d-block w-100" alt="Sertanejo">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>Sertanejo</h4>
        <p>Pão Normal, Hamburguer Artesanal, Queijo Coalho, Carne de sol desfiada, Alface, Tomate, Cebola dourada</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Imagens/X-Calabresa.png" class="d-block w-100" alt="X-Calabresa">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>X-Calabresa</h4>
        <p>Pão Normal, Hamburguer, Queijo Muçarela, Catupiry, Calabresa</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Imagens/X-Frango.png?v=2" class="d-block w-100" alt="X-Frango">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>X-Frango</h4>
        <p>Pão Normal, Hamburguer, Alface, Tomate, Cebola, Frango Desfiado, Queijo Cheddar, Queijo Coalho</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Imagens/X-Picanha.png" class="d-block w-100" alt="X-Picanha">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>X-Picanha</h4>
        <p>Pão Levemente dourado, Catupiry, Alface, Tomate, Hamburguer Artesanal, Queijo Cheddar, Barbecue, Ovo Frito</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Imagens/X-Tudo.png?v=2" class="d-block w-100" alt="X-Tudo">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h4>X-Tudo</h4>
        <p>Pão Levemente Dourado, Hamburguer, Hamburguer Artesanal, Bacon, Calabresa, Frango Desfiado, Carne de sol desfiada, Queijo Muçarela, Queijo Coalho, Queijo Cheddar, Alface, Tomate, Cebola Dourada, Ovo Frito, Barbecue, Catupiry</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselHamburguer" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselHamburguer" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>