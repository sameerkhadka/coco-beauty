function searchFunction() {
    (function () {
        var showResults;
        $('.searchInput').keyup(function () {
            var searchText;
            searchText = $('.searchInput').val();
            return showResults(searchText);
        });
        showResults = function (searchText) {
            $('tbody tr').hide();
            return $('tbody tr:Contains(' + searchText + ')').show();
        };
        jQuery.expr[':'].Contains = jQuery.expr.createPseudo(function (arg) {
            return function (elem) {
                return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });
    }.call(this));
}

var btnOpen = document.querySelector('#aside-btn');
var mainContent = document.querySelector('.main-content');
var sideContent = document.querySelector('.main-aside');


if(btnOpen) {
    btnOpen.addEventListener('click', function(e){
    
        e.preventDefault();
        if(btnOpen.innerHTML === "Add New") {
          
            btnOpen.innerHTML = "Close";
        } else {
            btnOpen.innerHTML = "Add New";
        }
         
    
        mainContent.classList.toggle('aside-open');
        sideContent.classList.toggle('open');
    })
}




