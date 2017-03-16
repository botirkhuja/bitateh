app.controller('myCtrl', function($scope, $http)
{
	$scope.required = true;
	var todayDate = new Date();
	var thisYear = todayDate.getFullYear();
	var thisMonth = todayDate.getMonth();
	var thisDay = todayDate.getDay();
	$scope.years = [thisYear, thisYear+1];
	$scope.months = [
		{month : "January", number : 1},
		{month : "February", number : 2},
		{month : "March", number : 3},
		{month : "April", number : 4},
		{month : "May", number : 5},
		{month : "June", number : 6},
		{month : "July", number : 7},
		{month : "August", number : 8},
		{month : "September", number : 9},
		{month : "October", number : 10},
		{month : "November", number : 11},
		{month : "December", number : 12}
	];

  var chosenCategoryName = '';
  var selectedLanguage = 1;
  var langua = [
    {
      title: 'Texniko.uz Texnikalar Web Sayti',
      header1: 'Texniko.uz',
      header2: 'Toshkent orqali har qanday texnikalarni bizda zakaz qiling!',
      header3: 'Barcha turdagi texnikalar to\'plami',
      header4: 'Toshkentdagi eng sara kompaniyalardan hammasi shu yerda',
      header5: 'Ko\'proq malumot',
      modal1: 'Tavsif',
      modal2: 'Sotuvchi',
      modal3: 'Brendi',
      modal4: 'Xususiyatlari',
      navi1: 'Bosh',
      navi2: 'Kategoriyalar',
      navi3: 'Til',
      explain1: 'Bu web saxifa quyidagicha ishlaydi',
      explain2: 'Birini tanlang',
      explain3: 'Turli xil Kategoriyalardan',
      explain4: 'Tovarni ko\'ring',
      explain5: 'Yoqqanini belgilang',
      explain6: 'Qo\'ng\'iroq qil',
      explain7: 'Berilgan telefon raqamga',
      explain8: 'Manzilni ol',
      explain9: 'va borib harid qil',
      category1: 'Tanlash Uchun Kategoriyalar',
      refrigerators: 'muzlatgichlar',
      microwaves: 'Mikroto\'lqinli pechlar',
      tv: 'televizorlar',
      cellphone: 'Uyali telefonlar',
      items1: 'Kategoriya Tanlang',
      items2: 'Batafsil Malumot'
    },

    {
      title: 'Texniko.uz Мир технологий в Ташкенте',
      header1: 'Добро пожаловать на Texniko.uz',
      header2: 'Место, где вы можете заказать любые технологии в Ташкенте, Узбекистан',
      header3: 'Закажите у нас по низким ценам',
      header4: 'и ваш заказ доставляется в любое место в Ташкенте.',
      header5: 'Узнайте, как это работает.',
      modal1: 'Подробно',
      modal2: 'Продавец',
      modal3: 'Бренд',
      modal4: 'Характеристика',
      modal5: 'Закрыть',
      navi1: 'Главная',
      navi2: 'Категория',
      navi3: 'Язык',
      explain1: 'Вот как это работает',
      explain2: 'Выберите категорию',
      explain3: 'Из многих категорий мы имеем',
      explain4: 'Выберите товар',
      explain5: 'У нас есть разнообразные варианты',
      explain6: 'Связаться с продавцом',
      explain7: 'Информация о продавце доступна',
      explain8: 'Получить адрес',
      explain9: 'И купите свой выбор у продавца',
      category1: 'Категории для выбора',
      refrigerators: 'Холодильники',
      microwaves: 'микроволновые печи',
      tv: 'телевизоры',
      cellphone: 'сотовые телефоны',
      items1: 'Выберите категорию',
      items2: 'Детали'
    },

    {
      title: 'Texniko.uz The Techs World in Tashkent',
      header1: 'Welcome to Texniko.uz',
      header2: 'The place where you can order any techs in Tashkent, Uzbekistan',
      header3: 'Order from us in low prices',
      header4: 'and orders are delivered to any place in Tashkent.',
      header5: 'Learn how it works',
      modal1: 'Description',
      modal2: 'Seller Info',
      modal3: 'Brand',
      modal4: 'Features',
      modal5: 'Close',
      navi1: 'Home',
      navi2: 'Categories',
      navi3: 'Language',
      explain1: 'This is how it works',
      explain2: 'Select a category',
      explain3: 'From many categories we have',
      explain4: 'Choose an item',
      explain5: 'We have variety options',
      explain6: 'Contact to seller',
      explain7: 'Seller information is available',
      explain8: 'Check address',
      explain9: 'and buy your selection from seller',
      category1: 'Categories to Choose',
      refrigerators: 'refrigerators',
      microwaves: 'microwaves',
      tv: 'tv',
      cellphone: 'cell phone',
      items1: 'Select a category',
      items2: 'View details'
    }
  ];

  $scope.languages = langua[selectedLanguage];

  $scope.changeLang = function (lang) {
    $scope.languages = langua[lang];
    selectedLanguage = lang;
    $scope.chosenCategory = $scope.languagesCategoryOrItemName(chosenCategoryName);
  }

  $scope.languagesCategoryOrItemName = function (target) {
    if (langua[selectedLanguage][target] == '' || langua[selectedLanguage][target] == null) {
      return target;
    } else {
      return langua[selectedLanguage][target];
    };

  }

	$scope.categoryNames = [];
    $http.get("categoryNames.php").then(function (response) {
    	$scope.categoryNames = response.data;
    });


     //$.ajax({
		// 	url: 'categoryNames.php',
		// 	success: function (result) {
		// 		$scope.categoryNames = result;
		// 	}
		// });

	$scope.showCheckOut=false;
	$scope.showItems=false;
	$scope.count=0;
	$scope.cart = [];

	$scope.payer = {};
	$scope.receiver = {};
	$scope.deliveryDate = {};

	$scope.daysInMonth = function (month, year) {
		$scope.days = [];
		var day;
		if (month.number === 1 || month.number === 3 || month.number === 5 ||
			month.number === 7 || month.number === 8 || month.number === 10 ||
			month.number === 12) {day=31;} 
		else if(month.number === 2 && isLeapYear(year)){day=29;}
		else if (month.number === 2 && !isLeapYear(year)){day=28;}
		else {day=30;}
		for (var i = 1; i <= day; i++) {
			$scope.days.push(i);
		};
	}

	function isLeapYear(year){
  		return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0) ? true: false;
	}

	$scope.categorySelected = function (chosenCategory) {
		// $http.get("categories.php?selectedCategory="+chosenCategory.toString()).then(function (response) {
		// 	$scope.itemNames = response.data.records;
		// });

  	$scope.showItems=true;

		$.ajax({
			url: 'categories.php',
			data: chosenCategory,
			success: function (result) {
				$scope.$apply(function () {
					$scope.itemNames = result;
				})
			}
		});

    chosenCategoryName = chosenCategory.CategoryName;
		$scope.chosenCategory = $scope.languagesCategoryOrItemName(chosenCategoryName);

		//This is old request used with ajax
		/*var xhttp;
    	xhttp = new XMLHttpRequest();
      	xhttp.onreadystatechange = function () {
        	if (xhttp.readyState == 4 && xhttp.status == 200) {
          		document.getElementById("itemsPage").innerHTML = xhttp.responseText;
        	};
    	};
    	var url = "categories.php?selectedCategory=" + argument.toString();
      	xhttp.open("GET", url, true);
      	xhttp.send();*/

  };

    $scope.addToCart = function (item) {
  		$scope.showCheckOut=true;
  		var quantityIncreased = false;
  		if ($scope.cartQuantity > 0 || $scope.cartQuantity != null) {
  			$scope.cart.forEach(function (inCartItem, index) {
  				if (inCartItem.ItemID === item.ItemID){
  					inCartItem.Quantity ++;
  					quantityIncreased = true;
  				}
  			});
  			if (!quantityIncreased) {
    			$scope.cart.push(angular.extend({Quantity: 1},item));
    			quantityIncreased = false;
  			};
  		}
  		else {
    		$scope.cart.push(angular.extend({Quantity: 1},item));
  		};
    	$scope.cartQuantity = $scope.cart.length;
    }

    $scope.removeFromCart = function (item) {
    	$scope.cart.splice(item, 1);
    	$scope.cartQuantity = $scope.cart.length;
    	if ($scope.cartQuantity === 0) {
    		$scope.showCheckOut=false;
    	};
    }

    $scope.getCartPrice = function () {
    	var total=0;
    	$scope.cart.forEach(function (product) {
    		total += product.Price * product.Quantity;
    	});
    	return total;
    };

    $scope.viewDetails = function (item) {
      $('#itemInfoModal').modal('toggle');
      $(document).ready(function(){
        $scope.item = item;
        $.ajax({
          url: 'getItemImages.php',
          data: item,
          success: function (result) {
            $scope.$apply(function () {
              $scope.imageNames = result;
            })
          }
        });

        $.ajax({
          url: 'getSellerInfo.php',
          data: item,
          success: function (result) {
            $scope.$apply(function () {
              $scope.seller = result[0];
            })
          }
        });
      });

      $('#myModal').on('hidden.bs.modal', function (e) {
        // $scope.imageNames
      })
    }

    $('#sellerTab').click(function (argument) {
      // argument.preventDefault();
      $(this).tab('show');
    });
    $('#descTab').click(function (argument) {
      // argument.preventDefault();
      $(this).tab('show');
    });
    
    // $scope.cancel = function (placeOrderForm) {
    // 	$scope.payer = angular.copy(emptyObject);
    // 	placeOrderForm.$setPristine();
    // 	placeOrderForm.$setUntouched();
    	
    //     $('form').find('input[type=text], input[type=password], input[type=number], input[type=email], textarea').val('');
    // }

    $scope.submit = function () {
    	var orderInfo = {
    		"payer":$scope.payer,
    		// "receiver":$scope.receiver,
    		// "deliveryDate":$scope.deliveryDate,
    		"itemsOrdered":$scope.cart
    		};

    	$.ajax({
    		url: "checkOut.php",
    		data: orderInfo,
    		success: function (success) {
          $scope.$apply(function () {
            // $scope.itemNames = result;
          })
    		}
    	})
    }

    $scope.test = function (argument) {
    	$http.get("categoryNames.php").then(function (response) {
    		$('#testing').html(response.data);
    	});
    }
});