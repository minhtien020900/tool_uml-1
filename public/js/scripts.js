$(document).ready(()=>{
    scrollFunction();

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

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {

        $("#navbar").show();
    } else {
        $("#navbar").hide();
    }
}
$("#wrap-top button").click(function(){
    $('#navbar').toggleClass('showing')
})
