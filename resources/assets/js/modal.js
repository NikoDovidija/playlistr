

const modal = {
    
    init : function(){
        $("body").on("click",'[data-open-modal]',function(){
            var modalName = $(this).attr('data-open-modal');
             console.log(modalName);
            modal.open(modalName);
        });

        $("body").on("click", '[data-close-modal]', function(){
            modal.close();
        })

        var options = {
            debug: 'info',
            modules: {
              toolbar: '#toolbar'
            },
            placeholder: 'Compose an epic...',
            readOnly: true,
            theme: 'snow'
          };

    },
    open : function(name){
        var highest = 0;
        // $(".modal-wrapper").each(function(el){
        //     var current = $(el).css("z-index");
        //     if(current>highest){
        //         highest = current;
        //     }
        // })
        
        $("#"+name).removeClass('hide').css("z-index",highest+1);
    },

    close : function(){
        $(".modal-wrapper").addClass('hide');
    }
}

$(document).ready(function(){
    modal.init();
});