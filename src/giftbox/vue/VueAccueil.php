<?php

namespace giftbox\vue;

use giftbox\controleur\ControleurPanier;

class VueAccueil
{
    private $selecteur;

    function __construct( $sel)
    {
        $this->selecteur = $sel;
    }

    public function admin($nbPrestation){
        $html =  "<div class=\"right item\">
                  <a class=\"ui inverted button\" href='/panier/charger' style=\"margin-right: 7px\">Gérer un coffret</a>
                  <a class=\"ui inverted button\" href=\"/panier\">
                  <i class=\"icon gift\"></i>Panier
                  <div class=\"floating ui red circular label\">$nbPrestation</div>
                  </a>
                  <a class=\"ui inverted button\" href=\"/deconnexion\">Déconnexion</a>
                  <a class=\"ui inverted button\" href=\"/gestion\">Gestion</a>
                </div>";
        return $html;
    }

    public function visiteur($nbPrestation){
       $html =  "<div class=\"right item\">
                      <a class=\"ui inverted button\" href='/panier/charger' style=\"margin-right: 7px\">Gérer un coffret</a>
                      <a class=\"ui inverted button\" href=\"/panier\">
                        <i class=\"icon gift\"></i>Panier
                        <div class=\"floating ui red circular label\">$nbPrestation</div>
                      </a>
                      <a class=\"ui inverted button\" href=\"/connexion\">Connexion</a>
                 </div>";
       return $html;
    }

    public function render($listePrest)
    {

        $BestPrest = "<div class=\"ui vertical stripe segment prest title\">
                        <div class=\"ui text container\">
                           <h3 class=\"ui header\">Nos Meilleurs Prestations</h3>
                        </div>
                      </div>
                      
                      <div class=\"ui vertical stripe quote segment\">
                        <div class=\"ui equal width stackable internally celled grid\">
                            <div class=\"center aligned row\">";

        foreach ($listePrest as $prestation){
            $BestPrest = $BestPrest."<div class=\"column\">
                                        <img class=\"ui small circular image\" src=\"/assets/img/" . $prestation->img . "\" style='margin-left:auto; margin-right:auto; width: 100px; height: 100px'>
                                        <h2>$prestation->nom</h2>
                                        <div class=\"meta\">
                                            <p class=\"categorie\">" . $prestation->categorie->nom . "</p>
                                        </div>
                                        <div class=\"extra content\">
                                        <span>
                                            $prestation->prix €
                                        </span>
                                        <br>
                                        <div class=\"ui star rating\" data-rating=\"" . $prestation->moyenne() . "\" data-max-rating=\"5\"></div><br /><br />
                                        <a class=\"ui large button\" href=\"/catalogue/".$prestation->id."\">Détail</a>
                                    </div>
                                    </div>";
        }

        $BestPrest = $BestPrest."       </div>
                                    </div>
                                </div>";

        switch ($this->selecteur){
            case "1":
                $menu = $this->admin(ControleurPanier::getAmountInBasket());
                break;
            default :
                $menu = $this->visiteur(ControleurPanier::getAmountInBasket());
                break;
        }



        $html = <<<END
        
        <!DOCTYPE html>
        <html>
        <head>
          <!-- Standard Meta -->
          <meta charset="utf-8" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        
          <!-- Site Properties -->
          <title>Accueil | Giftbox</title>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.6/semantic.min.css">
        
          <style type="text/css">
         
            
            .prest.title{
                text-align: center;
            }
        
            .hidden.menu {
              display: none;
            }
        
            .masthead.segment {
              min-height: 700px;
              padding: 1em 0em;
            }
            .masthead .logo.item img {
              margin-right: 1em;
            }
            .masthead .ui.menu .ui.button {
              margin-left: 0.5em;
            }
            .masthead h1.ui.header {
              margin-top: 3em;
              margin-bottom: 0em;
              font-size: 4em;
              font-weight: normal;
            }
            .masthead h2 {
              font-size: 1.7em;
              font-weight: normal;
            }
        
            .ui.vertical.stripe {
              padding: 8em 0em;
            }
            .ui.vertical.stripe h3 {
              font-size: 2em;
            }
            .ui.vertical.stripe .button + h3,
            .ui.vertical.stripe p + h3 {
              margin-top: 3em;
            }
            .ui.vertical.stripe .floated.image {
              clear: both;
            }
            .ui.vertical.stripe p {
              font-size: 1.33em;
            }
            .ui.vertical.stripe .horizontal.divider {
              margin: 3em 0em;
            }
        
            .quote.stripe.segment {
              padding: 0em;
            }
            .quote.stripe.segment .grid .column {
              padding-top: 5em;
              padding-bottom: 5em;
            }
        
            .footer.segment {
              padding: 5em 0em;
            }
        
            .secondary.pointing.menu .toc.item {
              display: none;
            }
        
            @media only screen and (max-width: 700px) {
              .ui.fixed.menu {
                display: none !important;
              }
              .secondary.pointing.menu .item,
              .secondary.pointing.menu .menu {
                display: none;
              }
              .secondary.pointing.menu .toc.item {
                display: block;
              }
              .masthead.segment {
                min-height: 350px;
              }
              .masthead h1.ui.header {
                font-size: 2em;
                margin-top: 1.5em;
              }
              .masthead h2 {
                margin-top: 0.5em;
                font-size: 1.5em;
              }
            }
        
        
          </style>
        
        </head>
        <body>
        
        <!-- Page Contents -->
        <div class="pusher">
          <div class="ui inverted vertical masthead center aligned segment">
        
            <div class="ui container">
              <div class="ui large secondary inverted pointing menu">
                <a class="toc item">
                  <i class="sidebar icon"></i>
                </a>
                <a class="active item" href="#">Accueil</a>
                <a class="item" href="/catalogue">Catalogue</a>
                $menu
              </div>
            </div>
        
            <div class="ui text container">
              <h1 class="ui inverted header">
                GiftBox
              </h1>
              <h2>Faites plaisir à vos proches pour pas chère !</h2>
              <a href="/catalogue"><div class="ui huge primary button">Se lancer <i class="right arrow icon"></i></div></a>
            </div>
        
          </div>
        
          $BestPrest   
        
        
          <div class="ui inverted vertical footer segment">
            <div class="ui container">
              <div class="ui stackable inverted divided equal height stackable grid">
                <div class="three wide column">
                  <h4 class="ui inverted header">About</h4>
                  <div class="ui inverted link list">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                    <a href="#" class="item">Religious Ceremonies</a>
                    <a href="#" class="item">Gazebo Plans</a>
                  </div>
                </div>
                <div class="three wide column">
                  <h4 class="ui inverted header">Services</h4>
                  <div class="ui inverted link list">
                    <a href="#" class="item">Banana Pre-Order</a>
                    <a href="#" class="item">DNA FAQ</a>
                    <a href="#" class="item">How To Access</a>
                    <a href="#" class="item">Favorite X-Men</a>
                  </div>
                </div>
                <div class="seven wide column">
                  <h4 class="ui inverted header">Footer Header</h4>
                  <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
          <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.6/semantic.min.js"></script>
          <script>
          $('.ui.rating').rating('disable');
          </script>
        
        </body>
        
        </html>

        
END;
        return $html;
    }
}
