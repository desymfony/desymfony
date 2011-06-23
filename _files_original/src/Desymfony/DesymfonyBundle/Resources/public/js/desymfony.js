$(function(){
    $('a.me_apunto').live('click', function(){

       $this = $(this);

       $.get($(this).attr('href'),function(data){
           $this.replaceWith(data);
       });

        return false;
    });
});

