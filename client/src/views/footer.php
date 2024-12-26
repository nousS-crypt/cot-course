<footer>
        <div class="footer-top">
            <div class="footer-section">
                <h3>ADRESSE</h3>
                <p>Cotonou<br>Sènadé Akpakpa</p>
            </div>
            <div class="footer-section">
                <h3>CONTACT</h3>
                <p>+229 90122612<br>noussecommerce@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>HORAIRES</h3>
                <p>Du lundi au Samedi<br>de 8h à 23h</p>
            </div>
            <div class="footer-section">
                <button class="contact-button">Contact</button>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="navigation">
                <h3>NAVIGATION</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Supermarchés</a></li>
                    <li><a href="#">Exploration</a></li>
                    <li><a href="#">Promotion</a></li>
                    <li><a href="#">Politique de Confidentialité</a></li>
                </ul>
            </div>
            <div class="productss">
                <h3>NOS PRODUITS</h3>
                <ul>
                    <li><a href="#">Produits Laitiers</a></li>
                    <li><a href="#">Chacuterie</a></li>
                    <li><a href="#">Patisserie</a></li>
                    <li><a href="#">Boissons</a></li>
                    <li><a href="#">Amuse bouche</a></li>
                    <li><a href="#">Fruits et Légumes</a></li>
                    <li><a href="#">Electroménagers</a></li>
                    <li><a href="#">Autres...</a></li>
                </ul>
            </div>
            <div class="supplier">
                <h3>FOURNISSEUR</h3>
                <img src="../img/u.jpeg" alt="Super U logo">
            </div>
            <div class="social-media">
                <img src="../img/montsinai.jpeg" alt="Mont sinai Facebook" width="150" height="150">
            </div>
        </div>

        <div class="footer-bottom-text">
            <p>Copyright © 2024 - 2025 - Tous droits réservés. <a href="#">Mentions légales</a>.</p>
        </div>
    </footer>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

footer {
    font-family: Arial, sans-serif;
}
    footer {
    color: white;
}

.footer-top {
    display: flex;
    justify-content: space-around;
    align-items: center;
    background-color: #ff66b2;
    padding: 20px;
    color: white;
}

.footer-top .footer-section h3 {
    color: #8b5eb2;
    margin-bottom: 10px;
}

.footer-top .footer-section p {
    color: white;
}

.contact-button {
    background-color: white;
    color: #8b5eb2;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.footer-bottom {
    display: flex;
    justify-content: space-around;
    background-color: #8b5eb2;
    padding: 20px;
}

.footer-bottom h3 {
    color: #ff66b2;
    margin-bottom: 10px;
}

.footer-bottom ul {
    list-style: none;
    text-align: start;
}

.footer-bottom a {
    color: black;
    text-decoration: none;
    display: block;
    margin: 5px 0;
}

.footer-bottom a:hover {
    text-decoration: underline;
}

.footer-bottom .supplier img,
.footer-bottom .social-media img {
    width: 100px;
    height: auto;
}

.footer-bottom-text {
    text-align: center;
    padding: 10px;
    background-color: #ff66b2;
    color: white;
}

.footer-bottom-text a {
    color: black;
    text-decoration: none;
}

.footer-bottom-text a:hover {
    text-decoration: underline;
}
</style>