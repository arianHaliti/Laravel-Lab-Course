function voteAjax(id,check,type,show,btn) {
	
	load_data(id);
    function load_data(id){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
               
            url: '/showvote',
            type: 'POST',
            data: {_token: CSRF_TOKEN,vote:$(show).text(),id : id,t :type},
            dataType: 'JSON',
            
            success: function (data) {
                // alert(data['sumVote']);
                $(show).html(data['sumVote']);
                
            },
            erro: function(){
                alert(0);
            }
        }); 
	}

	                        
    $(document).ready(function(){
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        //var q_i = "{{$question->question_id}}";
        
        $(btn).click(function() {
            if(check){
                var name = $(this).attr("name");
               
                //
                if(name =='up'){
                    $.ajax({

                        url: '/vote',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN,vote:$(show).text(),id : id,t :type},
                        dataType: 'JSON',

                        success: function (data) {
                        // alert(data['sumVote']);
                            $(show).html(data['sumVote']);
                            
                        },
                        erro: function(){
                            alert(0);
                        }
                    });         
                }else{
                    //alert(name);
                    $.ajax({

                        url: '/downvote',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN,vote:$(show).text(),id : id,t :type},
                        dataType: 'JSON',

                        success: function (data) {
                            // alert(data['sumVote']);
                            $(show).html(data['sumVote']);

                        },
                        erro: function(){
                            alert(0);
                        }
                    });       
                }
            
            }else{
                alert('Need Log');
            }

        });
            
        
    });    

}