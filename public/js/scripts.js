$(document).ready(()=>{
    $('#create-category').click(function(){
        $('#myModal').modal()
    })
    $('.fancybox div a').fancybox();
    $("#all-tags span").click(function(){
        console.log($(this).text()  );
        let strs =$(this).text()  ;

        $("#inputTags").tagsinput('add',strs)
    })
})
