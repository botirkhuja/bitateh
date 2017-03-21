<!DOCTYPE html>

<html data-ng-app="myApp" data-ng-controller="myCtrl">

  <head>
    <script type="text/javascript">if (window.location.protocol !== 'https:'){window.location = 'https://'+window.location.hostname+window.location.pathname;}</script>

    <?php include "admin/header.php"; ?>
    <title>{{languages.title}}</title>


    <style>
      body {
        position: relative;
        background-color: #DCDCDC;
      }
      .affix{
        top: 0;
        width: 100%;
        z-index: 10 !important;
      }
      .navbar {
        margin-bottom: 0px;
      }

      #jumbotron {
        margin-bottom: 0px;
        height: 600px;
        color: white;
        text-shadow: black 0.3em 0.3em 0.3em;
        background-image: url('img/modern-kitchen-1772638_1920_from_pixabay.jpg');
        background-size: cover;
        background-position: center;
      }
      .affix ~ .container-fluid{
        position: relative;
        top: 50px;
      }
      .affix ~ .container{
        position: relative;
        top: 50px;
      }
      #home {padding-top:50px;  }
      #categories {padding-top:50px; }
      #itemsPage {padding-top:50px;}
      #checkOut {padding-top:50px;}
      #footer {padding-top:50px;}

      .white {background-color: white;}

      .logo {
        font-size: 50px;
        padding-top: 10px;
        padding-bottom: 10px;
      }

      .txt-large{
        font-size: 18px;
      }

      .panel-footer{
        height 70px;
      }
      .bluring {
        -webkit-filter: blur(3px); /* Chrome, Safari, Opera */
        filter: blur(3px);
      }

      .thumbnail:hover{
        border-color: #99CCFF;
      }
      .thumbnail{
        border-color: white;
      }
      .modal-lg{
        padding-top:50px; 
      }
      input.ng-invalid-required.ng-touched{
        background-color: #ffd6cc;
      }
    </style>



  </head>

<body data-spy="scroll" data-target=".navbar" data-offset="60">

  <div >
    <div  >


      <!--Welcome Header-->
      <div class="jumbotron" id="jumbotron">
        <div id="intro" class="container text-center">
          <br><br><br>
          <h1 id="h12">{{languages.header1}}</h1>

          <h2>{{languages.header2}}</h2>
          <br>
          <p>{{languages.header3}}<br>{{languages.header4}}</p>
          <br>
          <a href="#home" class="btn btn-primary btn-lg navigation-bar" role="button">{{languages.header5}}</a>
        </div>
      </div>
  

      <!-- Item info modal -->
      <div class="modal fade bs-example-modal-lg" id="itemInfoModal" tabindex="-1" role="dialog" aria-labelledby="itemInformationModal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="itemInformationModal">{{item.Title}}</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <!-- Place for pictures -->
                <div class="col-md-5">
                  <!-- Start of carousel -->
                  <div id="galary-carousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <!--<ol class="carousel-indicators">-->
                      <!--<li data-target="#galary-carousel" data-slide-to="{{$index}}" data-ng-class="{active:!$index}" data-ng-repeat="imageName in imageNames"></li>-->
                    <!--</ol>-->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="item" data-ng-class="{active:!$index}" data-ng-repeat="imageName in imageNames">
                        <img data-ng-src="img/items/{{imageName.ImageName}}" alt="{{$index}}">
                        <div class="carousel-caption">
                          ...
                        </div>
                      </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#galary-carousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#galary-carousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div> <!-- End of carousel -->
                </div> <!-- End of picture -->
                <!-- This place is for details -->
                <div class="col-md-7">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#description" id="descTab">{{languages.modal1}}</a></li>
                    <li role="presentation"><a href="#seller-info" id="sellerTab">{{languages.modal2}}</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="description" role="tabpanel" class="tab-pane active">
                      <dl class="dl-horizontal">
                        <dt>{{languages.modal3}}</dt>
                        <dd class="text-capitalize">{{item.Brand}}</dd>
                        <dt>Model</dt>
                        <dd>{{item.Model}}</dd>
                        <dt>{{languages.modal4}}</dt>
                        <dd><p>{{item.Description}}</p></dd>
                      </dl>
                    </div>
                    <div id="seller-info" role="tabpanel" class="tab-pane">
                      <!-- <dl class="dl-horizontal">
                        <dt>Seller</dt>
                        <dd>{{seller.FirstName}}</dd>
                        <dt>Company</dt>
                        <dd>{{seller.BusinessName}}</dd>
                        <dt>Phone Number</dt>
                        <dd>+998-{{seller.AreaCode}}-{{seller.PhoneNumber}}</dd>
                        <dt>Address</dt>
                        <dd>{{seller.BusinessAddress}}</dd>
                      </dl> -->
                      <br><br>
                      <address>
                        <strong>{{seller.BusinessName}}</strong><br>
                        {{seller.BusinessAddress}}<br>
                        <abbr title="Phone">P:</abbr> (+998{{seller.AreaCode}}){{seller.PhoneNumber}}
                      </address>

                      <address>
                        <strong>{{seller.FirstName}}</strong><br>
                        <a href="mailto:#">{{seller.Email}}</a>
                      </address>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{languages.modal5}}</button>
              <!-- <button type="button" class="btn btn-primary">Contact Seller</button> -->
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- End of modal -->


      <!-- Navigation Bar -->
      <nav class="navbar navbar-default" data-spy="affix" data-offset-top="600">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navigation-bar" href="#intro">Texniko.uz</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="active"><a class="navigation-bar" href="#home">{{languages.navi1}}</a></li>
              <li><a class="navigation-bar" href="#categories">{{languages.navi2}}</a></li>
              <li><a class="navigation-bar" href="#itemsPage"><small data-ng-hide="showItems">{{languages.items1}}</small>{{chosenCategory | uppercase}}</a></li>
              <!-- <li><a class="navigation-bar" href="#checkOut" data-ng-show="showCheckOut">Check Out</a></li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <!-- <li><a class="navigation-bar" href="#checkOut">Shopping <span class="glyphicon glyphicon-shopping-cart"> <span class="badge">{{cartQuantity}}</span></span></a></li> -->
              <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
              <li class="dropdown">
                <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-flag"></span>{{languages.navi3}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a data-ng-click="changeLang(0)">Uzb</a></li>
                  <li><a data-ng-click="changeLang(1)">Rus</a></li>
                  <li><a data-ng-click="changeLang(2)">Eng</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> <!-- End of Navigation Bar -->
      
      <!-- Explanation Part -->
      <div class="container text-center">
        <div id="home" class="jumbotron white">
          <h2>{{languages.explain1}}</h2>
          <hr class="divider">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">{{languages.explain2}}</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-hand-up logo"></span>
                </div>
                <div class="panel-footer">{{languages.explain3}}</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">{{languages.explain4}}</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-shopping-cart logo"></span>
                </div>
                <div class="panel-footer">{{languages.explain5}}</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">{{languages.explain6}}</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-phone-alt logo"></span>
                </div>
                <div class="panel-footer">{{languages.explain7}}</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">{{languages.explain8}}</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-map-marker logo"></span>
                </div>
                <div class="panel-footer">{{languages.explain9}}</div>
              </div>
            </div>
            <!-- <div class="col-lg-3 col-md-2 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Check and Install</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-check logo"></span>
                </div>
                <div class="panel-footer">You check your item and install it to use</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-2 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">Everything is Done</div>
                <div class="panel-body">
                  <span class="glyphicon glyphicon-thumbs-up logo"></span>
                </div>
                <div class="panel-footer">Your tech is ready and you can use it</div>
              </div>
            </div> -->
          </div>
        </div>
      </div> <!-- End of Explanation Part -->
      

      <!-- Categories to Choose -->
      <div class="container text-center">
        <div id="categories" class="jumbotron white">
          <h2>{{languages.category1}}</h2><br>
          <hr class="divider">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12" data-ng-repeat="target in categoryNames track by target.CategoryID">
              <a class="btn" data-ng-click="categorySelected(target)" href="#itemsPage">
                <div class="panel panel-default">
                  <div class="panel-heading txt-large">{{languagesCategoryOrItemName(target.CategoryName) | uppercase}}</div>
                  <div class="panel-body" style="padding: 0;">
                    <img data-ng-src="img/categories/{{target.CategoryImage}}" class="img-responsive" alt="{{languagesCategoryOrItemName(target.CategoryName)}}">
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div> <!-- End of Categories to Choose-->


      <script type="text/javascript" src="js_functions/myApp.js"></script>
      <script type="text/javascript" src="js_functions/myCtrl.js"></script>


      <!-- Items to Choose -->
      <div class="container text-center">
        <div id="itemsPage" class="jumbotron white">
            <h2 data-ng-show="showItems">{{languagesCategoryOrItemName(chosenCategory) | uppercase}}</h2>
            <h2 data-ng-hide="showItems"><a href="#categories" role="button" style="color: black;">{{languages.items1}}</a></h2>
            <hr class="divider">
            <div class="row" data-ng-show="showItems">
              <div class="col-sm-6 col-md-4 col-lg-3 col-xs-6" data-ng-repeat="item in itemNames track by item.ItemID">
                <div class="thumbnail">
                  <a data-ng-click="viewDetails(item)" role="button">
                    <img data-ng-src="img/items/{{item.Img}}" alt="item Image" class="img-responsive">
                  </a>
                  <div class="caption">
                    <a data-ng-click="viewDetails(item)" role="button" style="color: black;"><h4>{{item.Title}}</h4></a>
                      <h5>{{item.Price | currency}}</h5>
                    <p>
                      <!-- <a data-ng-click="addToCart(item)" href="#checkOut" class="btn btn-primary" role="button">Add to Cart</a> -->
                      <a data-ng-click="viewDetails(item)" class="btn btn-default" role="button">{{languages.items2}}</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div> <!-- End of Items to Choose -->


      <!-- Checking out part -->
      <div class="container" data-ng-show="showCheckOut">
        <div id="checkOut" class="jumbotron white" >
          <fieldset>
            <legend>Items Information</legend>
            <hr class="divider">
            <table class="table table-hover table-bordered table-condensed">
              <thead>
                <tr>
                  <th style="width: 0.5%" class="text-right">#</th>
                  <th style="width: 75%">Title</th>
                  <th style="width: 5%">Price</th>
                  <th style="width: 5%">Quantity</th>
                  <th style="width: 7%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr data-ng-repeat="items in cart track by items.ItemID">
                  <td class="text-right">{{$index+1}}</td>
                  <td>{{items.Title}}</td>
                  <td>{{items.Price | currency}}</td>
                  <td><input type="number" value="{{items.Quantity}}" data-ng-model="items.Quantity" style="width: 40px" min="1" name="quantity"/></td>
                  <td><a data-ng-click="removeFromCart($index)" role="button">Remove</a></td>
                </tr></tbody>
              <tbody>
                <tr style="background-color: white;">
                  <th class="text-right" colspan="3">Total:</th>
                  <th>{{getCartPrice() | currency}}</th>
                  <th><a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" role="button">Check Out</a></th>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <div>Cart content: {{cart}}</div>
          <!-- modal -->
          <div data-ng-include="'checkOut.html'"></div>
        </div>
      </div> <!-- End of Checking out part -->


    </div> <!-- End of AngularJS Ctrl -->
  </div> <!-- End of AngularJS App -->

  <div id="footer" class="container-fluid" style="">
  <footer>
  	<p><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Botirkhuja E. 2016</p>
  	<p>Contact information: <a href="botir90@gmail.com">botir90@gmail.com</a></p>
  </footer>

  </div>
</body>
</html>