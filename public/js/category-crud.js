function createCategory(route) {

    let categoryName = document.getElementById('category_name');
    let errors = document.getElementById('category_errors');
    let indexCategoryDiv = document.getElementById('category-index');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val(),
        }
    });
    
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: {
            category_name: categoryName.value,
        },
        success: function(data) {
            console.log(data);

            indexCategory(route);
            categoryName.value = '';


            // let input = '<label> <input type="checkbox" name="category-check" value="'+ data.category.id +'"></input> ' 
            // + data.category.category_name + '</label><br>';

            // indexCategoryDiv.insertAdjacentHTML('beforeend', input);

        },
        error: function(e) {
            console.log(e.responseJSON);
            $.each(e.responseJSON.errors, function(key, value) {

                if(key == 'category_name') errors.textContent = value;  
            
            });
        }
    });


}

function indexCategory(route) {

    let indexCategoryDiv = document.getElementById('category-index');

    // console.log(indexCategoryDiv.childNodes);
    Array.from(indexCategoryDiv.childNodes).forEach(element => {
        element.remove();
    });

    $.get(route, function(response) {

        Array.from(response.categories).forEach(element => {
            
            let input = '<label> <input class="form-control{{ $errors->has("category-check") ? " is-invalid" : "" }}" type="checkbox" name="category-check[]" value="'+ element.id +'"></input> '+ element.category_name+ '</label><br>';

            indexCategoryDiv.insertAdjacentHTML('beforeend', input);

        });

    });

}



