
    <link rel="stylesheet" href="Styles/acceuil.css">
<body>
    <!-- <ul id="menu" class="hidden">
        <li><a href="#">Se connecter</a></li>
        <li><a href="#">S'inscrire</a></li>
        <li><a href="#">Paramètres</a></li>
        <li><a href="#">Se déconnecter</a></li>
    </ul> -->

    <section class="promo-section">
        <h1>Profitez des Meilleures Offres</h1>
        <p>Économisez sur vos produits préférés !</p>
        <marquee direction="left" style="background-color:#8b5eb2;color:white">Tout les produits sur ce site sont à des prix promotionnels... Alors qu'attends-tu pour prendre ton bon de reduction personnalisé !</marquee>

    </section>
    <br>
    <br>

    <section class="product-section">
        <h2>Décrouvez les meilleurs offres de produits en fin de vie et à la longue conservation de vos Supermarchés préférés à moindre cout .  </h2>
        <br>
        <br>
        <br>

    <div class="product-grid">
        <div class="product-card">
            <img src="uploads/aeroport.jpg" alt="">
            <li><a href="index.php?pg=nouss&id=1"> <h2>Nouss</h2></a></li>  
        </div>

        <div class="product-card">
            <img src="uploads/aeroport.jpg" alt="">
            <li><a href="supermarketaeroport .html"> <h2>Super U Aéroport</h2></a></li>  
        </div>

        <div class="product-card">
            <img src="uploads/calavi.jpg" alt="">
            <li><a href="ucalavi.html"> <h2>Super U Calavi</h2></a></li>  
        </div>

         <div class="product-card">
                <img src="uploads/akpakpa.jpg" alt="">
                <li><a href="akp.html"> <h2>Super U Akpakpa</h2></a></li>  
         </div>

         <div class="product-card">
            <img src="uploads/WhatsApp Image 2024-10-15 à 22.56.19_33519440.jpg"  width="400" height="220">
            <li><a href="U.html"> <h2>Super U </h2></a></li>  
     </div>

        <div class="product-card">
            <img src="uploads/mont .jpg" alt="">
           <li><a href="mont.html"> <h2>Mont-Sinai</h2></a></li> 
        </div>

        <div class="product-card">
            <img src="uploads/Title Page.jpg" alt=""width="500" height="250" >
            <li><a href="franc.html"><span style="text-decoration-line: none;"><h2>Franc-Prix</h2></span></a></li>
        </div>

        <div class="product-card">
            <img src="uploads/du pont.jpg" alt="">
            <li><a href="pont calavi.html"> <h2>Du pont Calavi</h2></a></li>
        </div>

        <div class="product-card">
            <img src="uploads/pont fidjosse.jpg" alt="">
            <li><a href="pontcotonou.html"> <h2>Du pont Fidjosse</h2></a></li>
        </div>

        <div class="product-card">
            <img src="uploads/millium.jpg" alt="">
            <li><a href="milii.html"> <h2>Millium</h2></a></li>
        </div>

        <div class="product-card">
            <img src="uploads/24.jpg" alt="">
            <li><a href="24.html"> <h2>24 heures</h2></a></li>
        </div>

        <div class="product-card">
            <img src="uploads/COMERCOO.jpg" alt="">
            <li><a href="commerco.html"> <h2>Comercoo</h2></a></li>
        </div>

    </div>
    <br>
    <br>
    <br>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>
    <script>
        function ajouterAuPanier(nom, prix) {
    const panierContainer = document.getElementById("panierContainer");

    const produitCard = document.createElement("div");
    produitCard.classList.add("produit-card");

    produitCard.innerHTML = `
        <h3>${nom}</h3>
        <p class="price">${prix}€</p>
        <button onclick="retirerDuPanier(this)">Retirer du panier</button>
    `;

    panierContainer.appendChild(produitCard);
}

function retirerDuPanier(button) {
    const produitCard = button.parentElement;
    produitCard.remove();
}

    </script>
</body>
</html>
