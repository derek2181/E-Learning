$(document).ready(function () {
    $("#category_select").tokenize2({
        dataSource: 'select',
        tokensAllowCustom: false,
        dropdownSelectFirstItem:true,
        displayNoResultsMessage:true,
        noResultsMessageText:'No existe la categoria "%s"',
        placeholder: "Escribe las categorias del curso." 
    });

    $("#category_search").tokenize2({
        dataSource: 'select',
        tokensAllowCustom: false,
        dropdownSelectFirstItem:true,
        displayNoResultsMessage:true,
        noResultsMessageText:'No existe la categoria "%s"',
        placeholder: "Escribe las categorias del curso." ,
        tokensMaxItems:1
    });

    $("#user_search").tokenize2({
        dataSource: 'select',
        tokensAllowCustom: false,
        dropdownSelectFirstItem:true,
        displayNoResultsMessage:true,
        noResultsMessageText:'No existe el usuario "%s"',
        placeholder: "Escribe el usuario que quieres buscar." ,
        tokensMaxItems:1
    });
    // Para traerse las sugerencias con ajax con un json
    //https://www.jqueryscript.net/form/Dynamic-Autocomplete-Tag-Input-Plugin-For-jQuery-Tokenize2.html
    // DOCUMENTACION : https://dragonofmercy.github.io/Tokenize2/

    // $("#category-select").tokenize2({
    //     dataSource:"resource.php" 
    // });
        
});