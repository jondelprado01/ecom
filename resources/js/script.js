$(document).ready(function(){

    //SELECT2 - MULTIPLE SELECT FOR PRODUCT CATEGORIES
    $('.product_category').select2();

    let product = new DataTable('.product-table', {
        responsive: true
    });

    let category = new DataTable('.category-table', {
        responsive: true
    });

    let user = new DataTable('.user-table', {
        responsive: true
    });

    var form = new FormData();

    //SUBMIT FORM - ADD
    $(".btn-save-category, .btn-save-product").on("click", function(){

        var type = $(this).attr("request-type");
    
        $("."+type+"-input").each(function(){
            if ($(this).attr("name") == "product_image") {
                form.append($(this).attr("name"), $('input[type=file]')[0].files[0]);
            }
            else{
                form.append($(this).attr("name"), $(this).val());
            }
        });

        $.ajax({
            type: "post",
            url: "/api/"+type+"-add",
            processData: false,
            contentType: false,
            cache: false,
            data: form,
            dataType: "json",
            beforeSend: function(){
                loader();
            },
            success: function(data){
                setTimeout(function(){
                if (data == 1) {
                    successMessage("Saved");
                }
                }, 1500);
            },
            error: function(xhr, status, error) {
                setTimeout(function(){
                    requestError(xhr.responseJSON.errors);
                }, 1500);
            }
        });

    });

    //SUBMIT FORM - EDIT 
    $(".btn-edit-category, .btn-edit-product").on("click", function(){

        var id = $(this).attr("id");
        var type = $(this).attr("request-type");

        $("."+type+"-input-"+id).each(function(){
            if ($(this).attr("name") == "product_image") {
                form.append($(this).attr("name"), $(this).prop('files')[0]);
            }
            else{
                form.append($(this).attr("name"), $(this).val());
            }
        });

        $.ajax({
            type: "post",
            url: "/api/"+type+"-edit/"+id,
            processData: false,
            contentType: false,
            cache: false,
            data: form,
            dataType: "json",
            beforeSend: function(){
                loader();
            },
            success: function(data){
                console.log(data);
                setTimeout(function(){
                    successMessage("Edited");
                }, 1500);
            },
            error: function(xhr, status, error) {
                setTimeout(function(){
                    requestError(xhr.responseJSON.errors);
                    console.log(xhr);
                }, 1500);
            }
        });

    });

    //SUBMIT FORM - DELETE 
    $(".btn-delete-category, .btn-delete-product, .btn-delete-user").on("click", function(){

        var id = $(this).attr("id");
        var type = $(this).attr("request-type");
        var name = $(this).attr("data-target");

        Swal.fire({
            title: "Delete "+name+" ?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: "/api/"+type+"-delete/"+id,
                    dataType: "json",
                    beforeSend: function(){
                        loader();
                    },
                    success: function(data){
                        setTimeout(function(){
                            if (data == 1) {
                                successMessage("Deleted");
                            }
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        setTimeout(function(){
                            requestError(xhr.responseJSON.errors);
                        }, 1500);
                    }
                });
            }
          });

    });

    //SUBMIT FORM - EDIT CHANGE USER ROLE
    $(".btn-toadmin-user").on("click", function(){

        var id = $(this).attr("id");
        var type = $(this).attr("request-type");
        var name = $(this).attr("data-target");

        Swal.fire({
            title: "Make "+name+" an Admin?",
            text: "This will change the current role of this user.",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/api/"+type+"-edit/"+id,
                    dataType: "json",
                    beforeSend: function(){
                        loader();
                    },
                    success: function(data){
                        setTimeout(function(){
                            if (data == 1) {
                                successMessage("Edited");
                            }
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        setTimeout(function(){
                            requestError(xhr.responseJSON.errors);
                        }, 1500);
                    }
                });
            }
          });

    });

});

function loader(){
    swal.fire({
      title: "Processing please wait....",
      allowEscapeKey: false,
      allowOutsideClick: false,
      showConfirmButton: false,
      didOpen: () => {
        swal.showLoading();
      }
    });
}

function successMessage(type){
    swal.fire({
        icon: "success",
        title: "Success!",
        html: "<b class='swal_success'>Record "+type+" Successfully.</b>",
    }).then(function(){
        window.location.reload();
    });
}

function requestError(error){

    var err_msg = "";

    $.each(error, function(key, value){
        err_msg += value+"<br>";
    });

    Swal.fire({
        icon: "error",
        title: "Something went Wrong!",
        html: err_msg,
    });

}


// for (var pair of form.entries()) {
//     console.log(pair[0]+ ', ' + pair[1]); 
// }