function voteAjax(id,check) {
	
	load_data(id);
    function load_data(id){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
               
            url: '/showvote',
            type: 'POST',
            data: {_token: CSRF_TOKEN,vote:$("#total_votes").text(),q : id},
            dataType: 'JSON',
            
            success: function (data) {
                // alert(data['sumVote']);
                $("#total_votes").html(data['sumVote']);
                
            },
            erro: function(){
                alert(0);
            }
        }); 
	}

	                        
    $(document).ready(function(){
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var q_id = id;
        var islog = check ;
        
        //var q_i = "{{$question->question_id}}";
       
        $("#up").on('click',function(){
            if(islog){
            $.ajax({
               
                url: '/vote',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$("#total_votes").text(),q : q_id,t :'up'},
                dataType: 'JSON',
                
                success: function (data) {
                   // alert(data['sumVote']);
                    $("#total_votes").html(data['sumVote']);
                    
                },
                erro: function(){
                    alert(0);
                }
            }); 
        }else{
            alert('Need Log');
        }

        });
        $("#down").on('click',function(){
            if(islog){
            $.ajax({
               
                url: '/downvote',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$("#total_votes").text(),q : q_id,t :'down'},
                dataType: 'JSON',
                
                success: function (data) {
                   // alert(data['sumVote']);
                    $("#total_votes").html(data['sumVote']);
                    
                },
                erro: function(){
                    alert(0);
                }
            }); 
        }else{
            alert('Need Log');
        }
        });        
        
    });   

}